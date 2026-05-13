<script setup>
    import axios from 'axios'
    import { onMounted, reactive, ref } from 'vue';
    import Base from '../../layouts/admin/Base.vue';
    import Nav from '../../layouts/admin/Nav.vue';

    const form = reactive({
        name: '',
        email: '',
        phone: '',
        address: '',
        description: '',
        summary: '',
        tagline: '',
        home_image: '',
        banner_image: '',
        cv: '',
    });

    let errors = ref([]);

    onMounted(async () => {
        getAbout();
    });

    const getAbout = async () =>{
        await axios.get('/api/abouts').then(({data}) => {
            console.log('data', data);
            form.name = data.about.name;
            form.email = data.about.email;
            form.phone = data.about.phone;
            form.address = data.about.address;
            form.description = data.about.description;
            form.summary = data.about.summary;
            form.tagline = data.about.tagline;
            form.home_image = data.about.home_image;
            form.banner_image = data.about.banner_image;
            form.cv = data.about.cv;
        });
    }

    const getHomeImage = () => {
        if(form.home_image){
            return '/upload/' + form.home_image;
        }
        return '/template/assets/img/avatar.jpg';
    }
    const getBannerImage = () => {
        if(form.banner_image){
            return '/upload/' + form.banner_image;
        }
        else {
            return '/template/assets/img/avatar.jpg';
        }
    }

    const handleHomeImageChange = (e) => {
        form.home_image = e.target.files[0];
        let reader = new FileReader
        reader.onload = (e) => {
            let output = document.getElementById('home-img');
            output.src = reader.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
    const handleBannerImageChange = (e) => {
        form.banner_image = e.target.files[0];
        let reader = new FileReader();
        reader.onload = (e) => {
            let output = document.getElementById('banner-img');
            output.src = reader.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
    const handlePdfChange = (e) => {
        form.cv = e.target.files[0];
    }
    const handleSave = async () => {
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('email', form.email);
        formData.append('phone', form.phone);
        formData.append('address', form.address);
        formData.append('description', form.description);
        formData.append('summary', form.summary);
        formData.append('tagline', form.tagline);
        formData.append('home_image', form.home_image);
        formData.append('banner_image', form.banner_image);
        formData.append('cv', form.cv);

        await axios.post('/api/abouts', formData)
        .then(({data}) => {
            toast.fire({
                icon: 'success',
                title: 'About me updated!'
            });
            getAbout();
        })
        .catch((error) => {
            if(error.response.status === 422) {
                // console.log('errors', error.response.data.errors);
                errors.value = error.response.data.errors;
            }
        });
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
                            <h1>About Me</h1>
                            <button class="secondary" @click="handleSave">
                                Update Changes
                            </button>
                        </div>
                        <div class="card-wrapper">
                            <div class="wrapper_left">
                                <div class="card">
                                    <label>Full Name</label>
                                    <span style="color:red" v-if="errors.name">{{ errors.name[0] }}</span>
                                    <input type="text" v-model="form.name" />

                                    <label>Email</label>
                                    <span style="color:red" v-if="errors.email">{{ errors.email[0] }}</span>
                                    <input type="email" v-model="form.email" />

                                    <label>Phone</label>
                                    <input type="text" v-model="form.phone" />

                                    <label>Address</label>
                                    <input type="text" v-model="form.address" />

                                    <label>Description</label>
                                    <textarea type="text" cols="10" rows="3" v-model="form.description"></textarea>

                                    <label>Summary</label>
                                    <textarea type="text" cols="10" rows="2" v-model="form.summary"></textarea>

                                </div>
                                <div class="card">
                                    <label>Tagline</label>
                                    <input type="text" v-model="form.tagline" />
                                </div>

                            </div>
                            <div class="wrapper_right">
                                <div class="card">
                                    <label>Home Image</label>
                                    <img :src="getHomeImage()" class="avatar_img" id="home-img" />
                                    <input type="file" @change="handleHomeImageChange" />
                                </div>
                                <div class="card">
                                    <label>About Image</label>
                                    <img :src="getBannerImage()" class="avatar_img" id="banner-img" />
                                    <input type="file" @change="handleBannerImageChange" />
                                </div>
                                <div class="card">
                                    <p>CV</p>
                                    <input accept="pdf/*" type="file" @change="handlePdfChange" />
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
        <section>
        </section>
    </section>
</template>