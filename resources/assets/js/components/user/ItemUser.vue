<template>
    <a v-if="itemUser" class="list-group-item">
        <div class="participant">
            <div class="participant-image">
                <img :src="sourceImage" class="img-circle" width="35" height="35">
            </div>
            <div class="participant-name">
                <p class="username">{{ itemUser.name }}</p>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        props: [
            'itemUser'
        ],
        computed: {
            sourceImage() {
                return "/image/" + this.itemUser.image;
            }
        },
    }
</script>
