<template>
    <div>
      <form class="form1">
        <fieldset
          v-bind:class="{validForm: newStudent.valid, invalidForm: newStudent.invalid}"
        >
          <legend>ADD STUDENT</legend>
          <div class="student">
            <label
              >First Name:
              <input
                type="text"
                v-model="newStudent.firstName"
                placeholder="Enter student's first name"
            /></label>
            <label
              >Last Name:
              <input
                type="text"
                v-model="newStudent.lastName"
                placeholder="Enter student's last name"
            /></label>
            <label
              >Expected Graduation Year:
              <input
                type="text"
                v-model="newStudent.graduationYear"
                placeholder="e.g. 2023"
            /></label>
            <label
              >GPA:
              <input
                type="text"
                v-model="newStudent.gpa"
                placeholder="Enter student's current GPA"
            /></label>
          </div>
          <fieldset
          class="register"
            v-bind:class="{validForm: registration.valid, invalidForm: registration.invalid}"
          >
            <legend class="reg">Course Registration</legend>
            <label
              >Course Number: 
              <select v-model="registration.courseNumber">
                <option value="CMSC1212">CMSC1212</option>
                <option value="CMSC1255">CMSC1255</option>
                <option value="CMSC1228">CMSC1228</option>
              </select></label
            >
            <label>
              Number of Credits: 
              <input
              type="number"
                v-model.number="registration.numOfCredits"
            /></label>

             
            <div class="att">
              <label>Attendance Type:</label> 
              <label>
                <input
                  type="radio"
                  value="Face-To-Face"
                  v-model="registration.attendanceType"
                />Face-To-Face
              </label>
              <label>
                <input
                  type="radio"
                  value="Synchronous Online"
                  v-model="registration.attendanceType"
                />Synchronous Online
              </label>
              <label>
                <input
                  type="radio"
                  value="Asynchronous Online"
                  v-model="registration.attendanceType"
                />Asynchronous Online
              </label>
            </div>
            
            <div class="format">
              <label>Book Format:</label> 
              <label>
                <input
                  type="checkbox"
                  value="Physical"
                  v-model="registration.bookFormat"
                />
                Physical
              </label>
              <label>
                <input
                  type="checkbox"
                  value="Digital"
                  v-model="registration.bookFormat"
                />
                Digital
              </label>
              <label>
                <input
                  type="checkbox"
                  value="Audio"
                  v-model="registration.bookFormat"
                />
                Audio
              </label>
            </div>
            <button
              type="submit"
              class="newStdBtn"
              v-on:click.prevent="register()"
            >
              Register
            </button>
          </fieldset>
        </fieldset>
        <div class="add">
          <button type="submit" v-on:click.prevent="setNewStudent()">
            ADD
          </button>
          <button
            class="add"
            type="reset"
            v-on:click.prevent="clearAllData()"
          >
            Clear Data
          </button>
        </div>
      </form>
    </div>
    
</template>

<script>
import store from "@/store/index.js";
export default {
    name: "Add-Student",
    data: function () {
        return {
          newStudent: {
              firstName: "",
              lastName: "",
              graduationYear: "",
              gpa: "",
              registrations: [],
              valid: false,
              invalid: true,
          },
          registration: {
              courseNumber: "",
              attendanceType: "",
              numOfCredits: "",
              bookFormat: [],
              valid: false,
              invalid: true,
          },
        };
    },
    methods: {
        setNewStudent: function (){
            const formdata = new FormData();
          var vm = this;
          formdata.append("firstName", this.newStudent.firstName);
          formdata.append("lastName", this.newStudent.lastName);
          formdata.append("graduationYear", this.newStudent.graduationYear);
          formdata.append("gpa", this.newStudent.gpa);
          formdata.append("registrations", JSON.stringify(this.newStudent.registrations));

          fetch("http://localhost/Week15/studentmanager/src/php/addStudent.php",{
            method: "post",
            body: formdata
          })
          .then(response => response.json())
          .then(function(data){
            if(data.status == "success"){
              vm.newStudent.firstName = "";
              vm.newStudent.lastName = "";
              vm.newStudent.graduationYear = "";
              vm.newStudent.gpa = "";
              vm.newStudent.registrations = [];
              vm.$router.push("studentsList");//studentsList//studentsList
              
              
            }else{
              console.log("Error");
            }
          });
        },
        clearAllData: function () {
        store.dispatch("clearData");
        },
        register: function () {
          let bookFormatString = "";
          this.registration.bookFormat.forEach((e,i) =>{
            bookFormatString += e;
            if(i < this.registration.bookFormat.length - 1){
              bookFormatString += ",";
            }
          });
          this.registration.bookFormat = bookFormatString;
        this.newStudent.registrations.push(Object.assign({}, this.registration));
        this.registration.courseNumber = "";
        this.registration.numOfCredits = "";
        this.registration.attendanceType = "";
        this.registration.bookFormat = [];
        
        },
    },
    watch: {
        student: {
        deep: true,
        handler() {
            this.setUpdated();
        },
        },
        newStudent: {
        handler: function () {
            if (
            !(
                this.newStudent.firstName != "" &&
                this.newStudent.lastName != "" &&
                this.newStudent.graduationYear != "" &&
                this.newStudent.gpa != ""
            )
            ) {
            this.newStudent.valid = false;
            this.newStudent.invalid = true;
            } else {
            this.newStudent.valid = true;
            this.newStudent.invalid = false;
            }
        },
        deep: true,
        },
        registration: {
        handler: function () {
            if (
            !(
                this.registration.courseNumber != "" &&
                this.registration.numOfCredits != ""
            )
            ) {
            this.registration.invalid = true;
            this.registration.valid = false;
            } else {
            this.registration.valid = true;
            this.registration.invalid = false;
            }
        },
        deep: true,
        },
    },
}
</script>

<style scoped>
  
.form1 {
  margin-left: auto;
  margin-right: auto;
  width: 80%;
  height: 100%;
  font-weight: 600;
}

.form1 fieldset {
  margin: 1rem;
}
.student input {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.student input {
  width: 30%;
}

.newStdBtn {
  margin-top: 1rem;
  box-shadow: 0.1rem 0.1rem 0.5rem lightblue;
  padding: 0.5rem;
  font-size: 1rem;
  color: white;
  background-color: black;
  border-radius: 0.5rem;
  border: none;
  width: 20%;
}
.add {
  display: flex;
  justify-content: center;
}
.add button {
  border-radius: 2rem;
  box-shadow: 0.1rem 0.1rem 0.1rem lightblue;
  padding: 0.5rem;
  font-size: 1rem;
  color: white;
  background-color: black;
  border-radius: 0.5rem;
  border: none;
  margin: 0.5rem;
}
legend {
  background-color: powderblue;
}
.reg {
  font-size: 1.1em;
}

.register select{
  display: block;
  margin-left: 31rem;
}
.register label {
  display: block;

}

.register input[type=number]{
  display: block;
  margin-left: auto;
  margin-right: auto;
}
.att label{
  text-align: left;
  margin-left: 30rem;
}
.format label{
  text-align: left;
  margin-left: 30rem;
}
.form1 input::placeholder {
  color: rgb(79, 77, 77);
}
.validForm {
  background-color: rgb(150, 240, 168);
  border: 0.5rem solid rgb(2, 115, 43);
}
.invalidForm {
  background-color: rgb(244, 184, 184);
  border: 0.5rem solid rgb(220, 14, 14); 
}

</style>