<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <p> {{ message }} </p>
  </div>
</template>

<script>
import store from '@/store/index';
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  computed: {
    message: function(){
      return store.state.msg;
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
p{
  text-align: left;
  width: 60%;
  color: #3e72c1;
  margin-left: 20rem;
  font-size: 1.5em;
}
</style>
