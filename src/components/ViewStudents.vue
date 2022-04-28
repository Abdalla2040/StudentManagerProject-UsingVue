<template>
    <div>
      <h2>{{ sectionTitle }}</h2>
      <div
        class="studentInfo"
        v-for="(singleStudent, index) in students"
        :key="index"
      >
        <p>First Name: {{ singleStudent.firstName }}</p>
        <p>Last Name: {{ singleStudent.lastName }}</p>
        <p>Full Name: {{singleStudent.firstName}}, {{singleStudent.lastName}} </p>
        <p v-show="singleStudent.graduationYear == 2023">
          Expected Graduation Year: {{ singleStudent.graduationYear }}
        </p>
        <p v-if="singleStudent.gpa >= 3">
          GPA: A - {{ singleStudent.gpa }}
        </p>
        <p v-else-if="singleStudent.gpa >= 2">
          GPA: B - {{ singleStudent.gpa }}
        </p>
        <p v-else-if="singleStudent.gpa >= 1">
          GPA: C - {{ singleStudent.gpa }}
        </p>
        <p v-else-if="singleStudent.gpa == 0">
          GPA: D - {{ singleStudent.gpa }}
        </p>
        <p v-else>
          GPA: F - {{ singleStudent.gpa }}
        </p>
        <div v-for="(register,indexes) in singleStudent.registrations" :key="indexes">
          <p>Course Number: {{register.courseNumber}}</p>
          <p>Attendance Type: {{register.attendanceType}}</p>
          <p>Number of Credits: {{register.credits}}</p>
          <p >Book Format: {{ register.bookFormat }}</p>
        </div>
        <div class="hr" v-if="index < students.length-1"><hr /></div>
      </div>
    </div>
</template>

<script>
export default {
    name: "StudentList",
    created:function(){
      this.getStudents();
    },
    data: function () {
    return {
      sectionTitle: "Student Personal Record",
      students: []
      
    };
  },
  methods:{
    getStudents: function(){
      var vm = this;
      fetch("http://localhost/Week15/studentmanager/src/php/getStudents.php").then(response => response.json()).then(function(data){
        vm.students = data.students;
      });
    }
  }
   
}
</script>

<style scoped>

</style>