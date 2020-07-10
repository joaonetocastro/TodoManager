<template>
  <v-list subheader two-line flat>
    <v-subheader>{{ title }}</v-subheader>

    <v-list-item-group multiple>
      <v-list-item v-for="todo in todos" :key="todo.id">
        <v-list-item-action v-on:click="toggle(todo)">
          <v-checkbox v-model="todo.done" 
                        v-bind:false-value="0"
                        v-bind:true-value="1"
                        color="primary"></v-checkbox>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>{{todo.title}}</v-list-item-title>
        </v-list-item-content>
        <v-list-item-action v-on:click="destroy(todo.id)">
          <v-btn small color="error">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
      <v-list-item v-if="enableAddTodo">
        <v-list-item-content>
          <v-list-item-title>
            <v-text-field :value="newTodoTitle" @input="value => {newTodoTitle = value}"></v-text-field>
          </v-list-item-title>
        </v-list-item-content>
        <v-list-item-action v-on:click="add()">
          <v-btn small color="primary">
            <v-icon>mdi-check</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
import axios from "axios";
export default {
  name: "TodoList",
  props: ["todos", "title", "enableAddTodo"],
  data() {
    return {
      newTodoTitle: ""
    };
  },
  methods: {
    toggle: function(todo) {
      axios.put(`http://localhost:8000/api/todos/${todo.id}`, todo);
    },
    destroy: function(id) {
      axios
        .delete(`http://localhost:8000/api/todos/${id}`)
        .then(() => this.$emit("todoDeleted", id));
    },
    add: function() {
      axios
        .post(`http://localhost:8000/api/todos/`, {
          title: this.newTodoTitle,
          done: false
        })
        .then(() => this.$emit("todoAdded"));
      this.newTodoTitle = "";
    }
  }
};
</script>
