<template>
    <div v-if="usersOnline" class="room-participant">
        <p class="participant-title">Người tham gia ({{ usersOnline.length }})</p>
        <div class="participant-list">
            <div class="list-group">
                <itemUser v-for="user in sortedArray" :key="user.id"
                :itemUser="user"></itemUser>
            </div>
        </div>
    </div>
</template>

<script>
    import ItemUser from './ItemUser.vue';

    export default {
        components: {
            itemUser: ItemUser
        },
        props: [
            'usersOnline'
        ],
        computed: {
            sortedArray() {
                return this.usersOnline.sort((a, b) => a.name > b.name);
            }
        },
        mounted() {

        }
    }
</script>
