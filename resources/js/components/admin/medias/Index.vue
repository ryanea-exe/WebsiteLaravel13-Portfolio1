<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import Base from '../../layouts/admin/Base.vue';
    import Nav from '../../layouts/admin/Nav.vue';
    import MediaForm from './Form.vue';
    import EventBus from '../../../lib/EventBus';

    let medias = ref([]);

    onMounted(async() => {
        getMedias();
    });

    EventBus.on('show-medias', (() => {
        getMedias();
    }));

    const getMedias = async () => {
        await axios.get('/api/medias')
        .then(({data}) => {
            // console.log('data', data);
            medias.value = data.medias;
        });
    }
    const deleteMedia = async (id) => {
        await axios.delete(`/api/medias/${id}`)
        .then(({data}) => {
            toast.fire({
                icon: 'success',
                title: 'Social Media Deleted!'
            })
            getMedias();
        })
    }
</script>

<template>
    <Base/>

    <section class="setting" id="setting">
        <div class="setting-wrapper">
            <div class="setting_nav">
                <div class="setting-titlebar">
                    <img src="/public/template/assets/img/avatar.jpg" alt="" class="setting-avatar">
                    <p>Natalia Brakux</p>
                </div>
                <Nav/>
            </div>
            <div class="setting_content">
                <section class="about" id="about">
                    <div class="titlebar">
                        <h1>Medias</h1>
                    </div>
                    <div class="card-wrappere">
                        <div class="card">
                            <h2>Social media</h2>
                            <div class="social_table-heading">
                                <p>Link</p>
                                <p>Icon</p>
                                <p></p>
                            </div>
                            <!-- item 1 -->
                            <div class="social_table-items" v-for="media in medias" :key="media.id">
                                <p>{{ media.link }}</p>
                                <button class="service_table-icon">
                                    <i :class="media.icon"></i>
                                </button>
                                <button @click="deleteMedia(media.id)">
                                    delete
                                </button>
                            </div>

                            <br/>

                            <MediaForm/>

                        </div>
                    </div>


                </section>
            </div>
        </div>
    </section>
</template>