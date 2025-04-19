import axios from 'axios';
import { ref } from 'vue';

export default function useStudent() {
  let students = ref({}),
    errors = ref({});

  const fetchStudents = async () => {
    try {
      let response = await axios.get('/api/students');
      students.value = response.data.data;
      console.log(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  const createStudent = async (form) => {
    try {
      //console.log(form);
      let response = await axios.post('/api/students', form);
      return response;
    } catch (error) {
      if (error.response && error.response.status === 422) {
        errors.value = error.response.data.errors;
      }

      return Promise.reject(error);
    }
  };

  const updateStudent = async (id, form) => {
    try {
      console.log(form);
      let response = await axios.put('api/students/' + id, form);
      return response;
    } catch (error) {
      if (error.response.status == 422) {
        errors.value = error.response.data.errors;
      }

      return Promise.reject(error);
    }
  };

  const getStudent = async (id) => {
    let response = await axios.get('api/students/' + id);
    return response.data;
  };

  return {
    fetchStudents,
    students,
    createStudent,
    errors,
    updateStudent,
    getStudent,
  };
}
