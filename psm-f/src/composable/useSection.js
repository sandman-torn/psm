import { ref } from 'vue';
import axios from 'axios';

export default function useSection() {
  let sections = ref([]);

  const fetchSections = async (class_id) => {
    try {
      let response = await axios.get('/api/sections?class_id=' + class_id);
      //console.log(response.data);

      sections.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  return { sections, fetchSections };
}
