<script setup>
import useClass from '@/composable/useClass';
import useSection from '@/composable/useSection';
import useStudent from '@/composable/useStudent';
import router from '@/router';
import { onMounted, reactive } from 'vue';
import { watch } from 'vue';
import { useRoute } from 'vue-router';

const { classes, fetchClasses } = useClass();
const { sections, fetchSections } = useSection();
const { updateStudent, errors, getStudent } = useStudent();

const route = useRoute();

const form = reactive({
    name: '',
    email: '',
    class_id: '',
    section_id: '',
});

watch(() => form.class_id,
    async newValue => {
        if (newValue) {
            await fetchSections(newValue);

            console.log(sections.value);
        }
    }
);

onMounted(async () => {
    await fetchClasses();
    //console.log(classes.value);
    //console.log(route.params.id);
    let response = await getStudent(route.params.id);
    form.name = response.name;
    form.email = response.email;
    form.class_id = response.class.id;
    form.section_id = response.section.id;

});

const submit = () => {
    updateStudent(route.params.id, form).then(() => {
        router.push({ name: 'students.index' });

    });
};

</script>

<template>
    <div class="mx-auto py-6 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                <form @submit.prevent="submit">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Student Information
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Use this form to create a new student.
                                </p>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input v-model="form.name" type="text" id="name"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error  @enderror"
                                        :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': errors.name, }" />
                                    <p v-if="errors.name" class="mt-2 text-red-500 text-sm">{{ errors.name[0] }}</p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        Address</label>
                                    <input v-model="form.email" type="email" id="email" autocomplete="email"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': errors.email, }" />
                                    <p v-if="errors.email" class="mt-2 text-red-500 text-sm">{{ errors.email[0] }}</p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="class_id" class="block text-sm font-medium text-gray-700">Class</label>
                                    <select v-model="form.class_id" id="class_id"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': errors.class_id, }">

                                        <option value="">Select a Class</option>
                                        <option v-for="item in classes" :key="item.id" :value="item.id">
                                            {{ item.name }}
                                        </option>
                                    </select>
                                    <p v-if="errors.class_id" class="mt-2 text-red-500 text-sm">{{ errors.class_id[0] }}
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="section_id"
                                        class="block text-sm font-medium text-gray-700">Section</label>
                                    <select v-model="form.section_id" id="section_id"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': errors.section_id, }">
                                        <option value="">Select a Section</option>
                                        <option v-for="section in sections" :key="section.id" value="{{section.id}}">{{
                                            section.name }}
                                        </option>
                                    </select>
                                    <p v-if="errors.section_id" class="mt-2 text-red-500 text-sm">{{
                                        errors.section_id[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <RouterLink :to="{ name: 'students.index' }"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                Cancel
                            </RouterLink>
                            <button type="submit"
                                class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>