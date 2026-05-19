<script setup>
    import axios from 'axios';
    import { reactive, ref } from 'vue';
    import EventBus from '../../../lib/EventBus';

    const showModal = ref(false)
    const editMode = ref(false)

    const form = reactive({
        company: "",
        period: "",
        position: "",
    })

    const openModal = () => {
        showModal.value = true
        editMode.value = false
    }

    const closeModal = () => {
        showModal.value = false
        form.company = ""
        form.period = ""
        form.position = ""
    }

    EventBus.on('show-experience-form', ((experience) => {
        showModal.value = true
        editMode.value = true
        form.id = experience.id
        form.company = experience.company
        form.period = experience.period
        form.position = experience.position
    }))

    const handleSave = async (values, actions) => {
        if (editMode.value) {
            updateExperience(values, actions)
        } else {
            createExperience(values, actions)
        }
    }

    const createExperience = async (values, actions) => {
        await axios.post(`/api/experiences`, form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Experience Added"
            })
            EventBus.emit('show-experiences')
        })
    }

    const updateExperience = async (values, actions) => {
        await axios.post(`/api/experiences/${form.id}`, form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Experience Updated"
            })
            EventBus.emit('show-experiences')
        })
    }
</script>

<template>
    <button @click="openModal">New Experience</button>

    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit Experience</span>
                <span v-else>Create Experience</span>
            </h2>
            <span @click="closeModal">×</span>
            <hr>
            <div>
                <p>Company</p>
                <input type="text" v-model="form.company" />

                <p>Period</p>
                <input type="text" v-model="form.period" />

                <p>Position</p>
                <input type="text" v-model="form.position" />
            </div>
            <hr>
            <div class="modal-footer">
                <button @click="closeModal">Cancel</button>
                <button class="secondary" @click="handleSave">
                    <span><i class="fa fa-spinner fa-spin"></i></span>Save
                </button>
            </div>
        </div>
    </div>
</template>