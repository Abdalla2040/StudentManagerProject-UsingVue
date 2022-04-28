<template>
    <div>
        <studentsList/>
    </div>
</template>

<script>
import studentsList from '@/components/ViewStudents.vue'
export default {
    name: 'StudentListView',
    components: {
    studentsList
  }
}
</script>