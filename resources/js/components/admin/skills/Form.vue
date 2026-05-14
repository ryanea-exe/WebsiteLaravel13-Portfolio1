<script setup>
    import axios from 'axios';
    import EventBus from '../../../lib/EventBus.js';
    import { ref, reactive, onMounted } from "vue";

    const form = reactive({
        name: '',
        proficiency: '',
        service_id: ''
    })

    const services = ref([])
    const errors = ref([])

    onMounted(async () => {
        getServices()
    })

    const showModal = ref(false)
    const editMode = ref(false)

    const openModal = () => {
        showModal.value = true
        editMode.value = false
    }

    const closeModal = () => {
        showModal.value = false
        form.name = ''
        form.proficiency = ''
        form.service_id = ''
    }

    EventBus.on('show-skill-form', (skill) => {
        showModal.value = true
        editMode.value = true
        form.id = skill.id
        form.name = skill.name
        form.proficiency = skill.proficiency
        form.service_id = skill.service_id
    })

    const getServices = async () => {
        await axios.get('/api/services')
        .then(({data}) => {
            services.value = data.services;
        });
    }

    const handleSave = async (values, actions) => {
        if (editMode.value) {
            updateSkill(values, actions)
        } else {
            createSkill(values, actions)
        }
    }

    const createSkill = async (values, actions) => {
        await axios.post('/api/skills', form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Skill Added"
            })
            EventBus.emit('show-skills')
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        })
    }

    const updateSkill = async (values, actions) => {
        await axios.post(`/api/skills/${form.id}`, form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Skill Updated"
            })
            EventBus.emit('show-skills')
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        })
    }
</script>

<template>
    <button @click="openModal">New Skill</button>

    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit Skill</span>
                <span v-else>Create Skill</span>
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr>
            <div>
                <p>Name</p>
                <span style="color: red" v-if="errors.name">{{ errors.name }}</span>
                <input type="text" v-model="form.name" />

                <p>Proficiency</p>
                <span style="color: red" v-if="errors.proficiency">{{ errors.proficiency }}</span>
                <input type="text" v-model="form.proficiency" />

                <p>Service</p>
                <select class="inputSelect" name="" id="" v-model="form.service_id">
                    <option disabled>Front-end developer</option>
                    <option :value="service.id" v-for="service in services" :key="service.id">{{ service.name }}</option>
                </select>
            </div>
            <hr>
            <div class="modal-footer">
                <button class="close-modal" @click="closeModal">
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