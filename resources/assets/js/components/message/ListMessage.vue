<template>
    <div v-if="messages && currentUser" class="message-list" v-chat-scroll>
        <ul class="list-group">
            <itemMessage v-for="message in sortedArray" :key="message.id"
            :message="message"
            :currentUser="currentUser"></itemMessage>
        </ul>
    </div>
</template>

<script>
    import ItemMessage from './ItemMessage.vue';

    export default {
        components: {
            itemMessage: ItemMessage
        },
        computed: {
            sortedArray() {
                return this.messages.sort((a, b) => a.created_at > b.created_at);
            }
        },
        props: [
            'messages',
            'currentUser'
        ],
    }
</script>
