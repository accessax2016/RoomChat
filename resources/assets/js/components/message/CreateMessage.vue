<template>
    <div v-if="currentUser" class="form-message">
        <textarea class="form-control" rows="3" placeholder="Nhập tin nhắn ..."
        v-model="message.content"
        @keyup.enter="postMessage" ></textarea>
    </div>
</template>

<script>
    export default {
        props: [
            'currentUser'
        ],
        data() {
            return {
                message: {
                    content: '',
                    user_id: this.currentUser.id,
                    room_id: this.$route.params.id
                }
            }
        },
        methods: {
            postMessage() {
                var app = this;
                if (app.message.content.length != 0) {
                    axios.post('/api/messages/create', app.message)
                        .then(function (response) {
                            // console.log(response);
                            app.message.content = '';
                            app.$emit('sendMessage', response.data);
                        })
                        .catch(function (error) {
                            // console.log(error);
                            alert("Error");
                        });
                }
                
            },
        },
        mounted() {

        }
    }
</script>
