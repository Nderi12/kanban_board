<template>
    <div class="container">
        <!-- Top Navbar -->
        <TopNavbar />
        <!-- /Top Navbar -->
        <div class="wrapper">
            <div class="main section">
              <img src="assets/images/path1.png" class="path">
                <h1 class="text-center">Draggable Kanban Board</h1>
                <div class="row">
                    <div class="card col-lg-4 card-columns m-2" v-for="column in columns" :key="column.title" :id="column.id">
                        <div class="row justify-content-between mx-2 mt-2">
                            <div class="card-header float-left"><h3>{{ column.title }}</h3></div>
                            <div class="">
                                <a class="btn btn-icon btn-sm btn-round btn-danger mr-2" @click="deleteColumn(column.id)"><i class="tim-icons icon-simple-remove"></i></a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-icon btn-sm btn-round btn-success" @click="updateColumnId(column.id)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  <i class="tim-icons icon-simple-add"></i>
                                </button>
                        </div>
                    </div>
                        <draggable 
                            :list="column.cards"
                            :data-id="column.id"
                            item-key="name"
                            :move="checkMove"
                            class="card-body"
                            group="people"
                            @start="dragging = true"
                            @end="dragging = false"
                        >
                            <template #item="{ element }">
                                <div class="card card-text p-2" style="background-color: #435181;">
                                    <h6>{{ element.title }}</h6>
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <Footer />
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form @submit.prevent="createNewCard">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title fs-5" id="exampleModalLabel">Add Card</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="tim-icons icon-simple-remove"></i>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label for="description">Title</label>
                        <input class="form-control" v-model="card.title" placeholder="Title" type="text" style="color: black;">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</template>
<script>
import draggable from "vuedraggable";
import TopNavbar from '.././layouts/top_nav.vue';
import Footer from '.././layouts/footer.vue';
export default {
  name: "App",
  components: {
    draggable,
    TopNavbar,
    Footer,
  },
  data() {
    return {
      title: '',
      card: {
        'title': '',
        'columnId': ''
      },
      columnId: '',
      cards: {},
      columns: [],
    };
  },
  methods: {
    getColumns() {
      axios.get("/api/columns").then((response) => {
        this.columns = response.data.columns;
      });
    },
    createNewColumn(){
      axios.post("/api/columns/", {
        title: this.title,
        _method: "POST",
      });
      this.getColumns();
    },
    //To-do: add a new method
    createNewCard(){
      axios.post("/api/cards/", {
        title: this.card.title,
        column_id: this.card.columnId,
        _method: "POST",
      });
      this.getColumns();
    },
    update(id, columnId){
      var data = {
        columnId: columnId
      }
        axios.put(`/api/cards/${id}`, data).then(response=>{
          console.log(response)
        }).catch(error=>{
            console.log(error)
        })
    },
    checkMove: function(e) {
      console.log(e)
    //   var cardId = e.dragged.attributes["data-id"].value;
    //   var columnId = e.to.attributes["data-id"].value;
    //   this.update(cardId, columnId)
    //   window.console.log("Future index: " + e.draggedContext.futureIndex);
    },
    deleteColumn(id) {
      if (confirm("Are you sure to delete this column ?")) {
        axios.delete("/api/columns/" + id)
          .then((response) => {
            this.getColumns();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    deleteCard(id) {
      if (confirm("Are you sure to delete this card ?")) {
        axios.delete("/api/cards/" + id)
          .then((response) => {
            this.getColumns();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    updateColumnId(id) {
        this.card.columnId = id;
    }
  },
  created() {
    this.getColumns();
  },
};
</script>

<style scoped>
.ghost-card {
  opacity: 0.5;
  background: #f7fafc;
  border: 1px solid #4299e1;
}
</style>

