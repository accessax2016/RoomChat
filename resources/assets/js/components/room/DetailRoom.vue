<template>
    <div v-if="room && currentUser" class="room-content">
        <div class="title">
            <p class="lead text-center">{{ room.name }}</p>
        </div>
        <div class="col-lg-8">
            <div class="chat-section">
                <listMessage :messages="room.messages" :currentUser="currentUser"></listMessage>
                <createMessage :currentUser="currentUser" v-on:sendMessage="pushMessage($event)"></createMessage>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="information-section">
                <div class="room-information">
                    <div class="room">
                        <div class="room-image">
                            <img :src="sourceImage" class="img-circle" width="60" height="60">
                        </div>
                        <div class="room-name">
                            <p class="name" style="margin-bottom: 0px;">{{ room.name }}</p>
                            <p class="name">Người tạo: {{ room.user.name }}</p>
                        </div>
                    </div>
                </div>
                <listUser :usersOnline="usersOnline"></listUser>
                <div class="room-action">
                    <br>
                    <router-link :to="{ path: '/home' }">
                        <button class="btn btn-danger btn-lg btn-block">Rời khỏi phòng</button>
                    </router-link>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ListMessage from '../message/ListMessage.vue'
    import ListUser from '../user/ListUser.vue'
    import CreateMessage from '../message/CreateMessage.vue'

    export default {
        components: {
            listMessage: ListMessage,
            listUser: ListUser,
            createMessage: CreateMessage,
        },
        computed: {
            sourceImage() {
                return "/image/" + this.room.image;
            },
        },
        data() {
            return {
                room: null,
                currentUser: null,
                usersOnline: null 
            }
        },
        methods: {
            getRoom(id) {
                var app = this;
                app.room = null;
                axios.get('/api/rooms/' + id)
                .then(function (response) {
                    // console.log(response);
                    app.room = response.data;
                })
                .catch(function (error) {
                    // console.log(error);
                    alert("Error");
                });
            },
            getCurrentUser() {
                var app = this;
                app.currentUser = null;
                axios.get('/api/users/current-user')
                .then(function (response) {
                    // console.log(response);
                    app.currentUser = response.data;
                })
                .catch(function (error) {
                    // console.log(error);
                    alert("Error");
                });
            },
            pushMessage(message) {
                this.room.messages.push(message);
            },
        },
        mounted() {
            this.getRoom(this.$route.params.id);
            this.getCurrentUser();

            Echo.join(`room.` + this.$route.params.id)
                .here((users) => {
                    this.usersOnline = users;
                })
                .joining((user) => {
                    this.usersOnline.push(user);
                    this.$toaster.success(user.name + ' đã vào phòng ' + this.room.name);
                })
                .leaving((user) => {
                    this.usersOnline.splice(this.usersOnline.indexOf(user), 1);
                    this.$toaster.error(user.name + ' đã rời phòng ' + this.room.name);
                })
                .listen('ChatEvent', (e) => {
                    this.pushMessage(e);
                });
        },
        watch: {
            '$route' (to, from) {
                Echo.leave(`room.` + from.params.id);
                Echo.join(`room.` + to.params.id)
                    .here((users) => {
                        this.usersOnline = users;
                    })
                    .joining((user) => {
                        this.usersOnline.push(user);
                        this.$toaster.success(user.name + ' đã vào phòng ' + this.room.name);
                    })
                    .leaving((user) => {
                        this.usersOnline.splice(this.usersOnline.indexOf(user), 1);
                        this.$toaster.error(user.name + ' đã rời phòng ' + this.room.name);
                    })
                    .listen('ChatEvent', (e) => {
                        this.pushMessage(e);
                    });
                this.getRoom(to.params.id);
            }
        }
    }
</script>
