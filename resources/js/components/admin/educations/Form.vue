<script setup>
    import axios from 'axios';
    import EventBus from "../../../lib/EventBus.js";
    import { ref, reactive } from "vue";

    const form = reactive({
        institution: "",
        period: "",
        degree: "",
        departement: ""
    })

    const showModal = ref(false)
    const editMode = ref(false)

    const openModal = () => {
        showModal.value = true
        editMode.value = false
    }

    const closeModal = () => {
        showModal.value = false
        form.institution = ""
        form.period = ""
        form.degree = ""
        form.departement = ""
    }

    EventBus.on('show-education-form', ((education) => {
        showModal.value = true
        editMode.value = true
        form.id = education.id
        form.institution = education.institution
        form.period = education.period
        form.degree = education.degree
        form.departement = education.departement
    }))

    const handleSave = async (values, actions) => {
        if (editMode.value) {
            updateEducation(values, actions)
        } else {
            createEducation(values, actions)
        }
    }

    const createEducation = async (values, actions) => {
        await axios.post(`/api/educations`, form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Education Added"
            })
            EventBus.emit('show-educations')
        })
    }

    const updateEducation = async (values, actions) => {
        await axios.post(`/api/educations/${form.id}`, form)
        .then(({data}) => {
            closeModal()
            toast.fire({
                icon: "success",
                title: "Education Updated"
            })
            EventBus.emit('show-educations')
        })
    }
</script>

<template>
    <button @click="openModal">New Education</button>

    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit Education</span>
                <span v-else>Create Education</span>
            </h2>
            <span @click="closeModal">×</span>
            <hr>
            <div>
                <label>Institution</label>
                <input type="text" v-model="form.institution" />

                <label>Period</label>
                <input type="text" v-model="form.period" />

                <label>Degree</label>
                <input type="text" v-model="form.degree" />

                <label>Departement</label>
                <input type="text" v-model="form.departement" />
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