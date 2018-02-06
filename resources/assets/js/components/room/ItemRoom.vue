<template>
    <router-link :to="{ name: 'detailRoom', params: {id: itemRoom.id} }" v-if="amountUsersInChannel" class="list-group-item">
        <div class="room">
            <div class="room-image">
                <img :src="sourceImage" class="img-circle" width="60" height="60">
            </div>
            <div class="room-name">
                <p class="name">{{ itemRoom.name }}</p>
                <p class="text-muted">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    {{ amountUsersInChannel.user_count }} người đang truy cập
                </p>
            </div>
        </div>
    </router-link>
</template>

<script>
    export default {
        props: [
            'itemRoom'
        ],
        computed: {
            sourceImage() {
                return "/image/" + this.itemRoom.image;
            }
        },
        data() {
            return {
                amountUsersInChannel: null
            }
        },
        methods: {
            getAmountUsersInChannel() {
                var app = this;
                app.currentUsersInChannel = null;
                axios.get('/api/users/users-in-channel/' + app.itemRoom.id)
                .then(function (response) {
                    // console.log(response);
                    app.amountUsersInChannel = response.data;
                })
                .catch(function (error) {
                    // console.log(error);
                    alert("Error");
                });
            }
        },
        mounted() {
            this.getAmountUsersInChannel();
        }
    }
</script>
