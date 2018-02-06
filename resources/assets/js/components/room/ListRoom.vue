<template>
    <div v-if="!loading" class="room-section">
        <div class="room-section-title">
            <p class="lead text-center">Danh Sách Phòng Chat ({{ itemRooms.length }})</p>
        </div>
        <div class="room-section-search">
            <input type="text" name="" class="form-control" placeholder="Tìm kiếm ...">
        </div>
        <div class="room-section-content">
            <div class="room-list">
                <div class="list-group">
                    <itemRoom v-for="itemRoom in sortedArray" :key="itemRoom.id"
                    :itemRoom="itemRoom"
                    ></itemRoom>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ItemRoom from './ItemRoom.vue';

    export default {
        components: {
            itemRoom: ItemRoom
        },
        computed: {
            sortedArray() {
                return this.itemRooms.sort((a, b) => a.created_at > b.created_at);
            }
        },
        data() {
            return {
                loading: false,
                itemRooms: null,
            }
        },
        methods: {
            getListRoom() {
                var app = this;
                app.loading = true;
                app.itemRooms = null;
                axios.get('/api/rooms')
                .then(function (response) {
                    // console.log(response);
                    app.itemRooms = response.data;
                    app.loading = false;
                })
                .catch(function (error) {
                    // console.log(error);
                    alert("Error");
                });
            }
        },
        created() {
            this.getListRoom();
        }
    }
</script>
