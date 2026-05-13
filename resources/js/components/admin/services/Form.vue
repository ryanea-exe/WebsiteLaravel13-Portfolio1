<script setup>
    import axios from 'axios';
    import { ref, reactive } from 'vue';
    import EventBus from '../../../lib/EventBus.js';

    const form = reactive({
        id: '',
        name: '',
        icon: '',
        description: '',
    })

    let errors = ref([]);

    const showModal = ref(false);

    const editMode = ref(false);

    const openModal = () => {
        showModal.value = true;
        editMode.value = false;
    }

    const closeModal = () => {
        showModal.value = false;
        form.name = '';
        form.icon = '';
        form.description = '';
    }

    EventBus.on('show-service-form', ((service) => {
        showModal.value = true;
        editMode.value = true;
        form.id = service.id;
        form.name = service.name;
        form.icon = service.icon;
        form.description = service.description;
    }))

    const handleSave = async (values, actions) => {
        if (editMode.value) {
            updateService(values, actions)
        } else {
            createService(values, actions)
        }
    }

    const createService = async (values, actions) => {
        await axios.post('/api/services', form)
            .then(({data}) => {
                closeModal();
                toast.fire({
                    icon: 'success',
                    title: 'Service Added!'
                })
                EventBus.emit('show-services');
            })
            .catch((error) => {
                if(error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
    }

    const updateService = async (values, actions) => {
        await axios.post(`/api/services/${form.id}`, form)
            .then(({data}) => {
                closeModal();
                toast.fire({
                    icon: 'success',
                    title: 'Service Updated!'
                })
                EventBus.emit('show-services');
            })
            .catch((error) => {
                if(error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            })
    }
</script>

<template>
    <button class="open-modal" @click="openModal">New Service</button>

    <div class="modal " :class="showModal ? 'show' :'' ">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Service
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr>
            <div>
                <label>Service Name</label>
                <span style="color: red" v-if="errors.name">{{ errors.name }}</span>
                <input type="text" v-model="form.name" />

                <label>Icon Class <span style="color:#006fbb;">(Find your suitable icon: Font
                        Awesome)</span></label>

                <input type="text" v-model="form.icon" />

                <label>Description</label>
                <textarea cols="10" rows="5" v-model="form.description"></textarea>
            </div>
            <hr>
            <div class="modal-footer">
                <button @click="closeModal">
                    Cancel
                </button>
                <button class="secondary" @click="handleSave">
                    <span><i class="fa fa-spinner fa-spin"></i></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</template>