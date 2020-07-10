<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <div class="d-flex align-center">Todo App</div>

      <v-spacer></v-spacer>

      <v-btn href="https://github.com/joaonetocastro/TodoManager" target="_blank" text>
        <span class="mr-2">Check out the Source Code</span>
        <v-icon>mdi-open-in-new</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <v-row class="text-center main-content">
          <TodoList
            title="To do"
            @todoDeleted="fetchTodos()"
            @todoAdded="fetchTodos()"
            :todos="todos.filter(todo => !todo.done)"
            :enableAddTodo="true"
          />
          <TodoList
            title="Done"
            @todoDeleted="fetchTodos()"
            :todos="todos.filter(todo => todo.done)"
          />
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import TodoList from "./components/TodoList";
import axios from "axios";

export default {
  name: "App",

  components: {
    TodoList
  },

  data: () => ({
    todos: []
  }),
  mounted() {
    this.fetchTodos();
  },
  methods: {
    fetchTodos: function() {
      axios.get("http://localhost:8000/api/todos").then(response => {
        this.todos = response.data;
      });
    },
  }
};
</script>

<style scoped>
.main-content {
  display: "flex";
  justify-content: space-evenly;
}
</style>