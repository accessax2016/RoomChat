<template>
    <li v-if="message && currentUser" class="list-group-item">
        <img v-if="!(message.user.id === currentUser.id)" :src="sourceImage" class="img-circle message-avatar pull-left" width="40" height="40" data-toggle="tooltip" data-placement="left" :title="message.user.name">
        <div class="clearfix" data-toggle="tooltip" data-placement="left" :title="message.created_at">
            <span class="message" :class="messageClass">{{ message.content }}</span>
        </div>  
    </li>
</template>

<script>
    export default {
        props: [
            'message',
            'currentUser'
            
        ],
        computed: {
            sourceImage() {
                return "/image/" + this.message.user.image;
            },
            messageClass() {
                if (this.message.user.id === this.currentUser.id) {
                    return "pull-right message-active";
                }
                else {
                    return "pull-left";
                }
            },
        },
        data() {
            return {
                
            }
        },
        methods: {

        },
        mounted() {

        },
    }
</script>
