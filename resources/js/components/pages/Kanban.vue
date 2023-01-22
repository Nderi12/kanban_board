  <template>
    <div>
        <!-- Top Navbar -->
        <TopNavbar />
        <!-- /Top Navbar -->
        <div class="wrapper">
            <div class="main section">
              <img src="assets/images/path1.png" class="path">
                <h1 class="text-center">Draggable Kanban Board</h1>
                <div class="container">
                  <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createColumn">
                    Create New Column
                  </button>
                  <div class="scrollable-list">
                    <div class="card col-lg-4 m-1" v-for="column in columns" :key="column.title" :id="column.id">
                        <div class="card-header row mb-2">
                          <div class="col-8" style="text-align: left; color: white;">
                                {{ column.title }}
                          </div>
                          <div class="col-4" style="text-align: right;">
                              <a class="" @click="deleteColumn(column.id)"><i class="tim-icons icon-trash-simple" style="color: pink;"></i></a>
                              <a class="ml-2" @click="updateColumnId(column.id)"><i class="tim-icons icon-simple-add" style="color: white;"></i></a>
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
                                <div class="card p-2" :data-id="element.id" style="background-color: #435181;">
                                  <div class="row">
                                      <div class="col-8" style="text-align: left; color: white;">
                                            <i class="tim-icons icon-bullet-list-67 mr-2"></i>{{ element.title }}
                                      </div>
                                      <div class="col-4" style="text-align: right;">
                                          <a class="" @click="editModal(element.id)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="tim-icons icon-pencil" style="color: white;"></i></a>
                                          <a class="ml-2" @click="deleteCard(element.id)"><i class="tim-icons icon-simple-remove" style="color: white;"></i></a>
                                      </div>
                                  </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                  </div>
                </div>
            </div>
            <!--Footer-->
            <Footer />
            <!-- Modal -->
            <div class="modal fade" id="createColumn" tabindex="-1" aria-labelledby="createColumnLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form @submit.prevent="createNewColumn">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title fs-5" id="createColumnLabel">Add Column</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="tim-icons icon-simple-remove"></i>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label for="description">Title</label>
                        <input class="form-control" v-model="title" placeholder="Title" type="text" style="color: black;">
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

            <div class="modal fade" id="createCard" tabindex="-1" aria-labelledby="createCardLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form @submit.prevent="createNewCard">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title fs-5" id="createCardLabel">Add Card</h4>
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

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form @submit.prevent="updateCard">
                  <div class="modal-content">
                    <div class="modal-header text-center">
                      <h4 class="modal-title fs-5" id="editModalLabel">Edit Card</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="tim-icons icon-simple-remove"></i>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label for="description">Title</label>
                        <input class="form-control" v-model="editableCard.title" placeholder="Title" type="text" style="color: black;">
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
      editableCard: {
        id: "",
        title: ""
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
    createNewColumn(){axios.post("/api/columns/", {
          title: this.title,
          _method: "POST",
      })
      .then((response) => {
        window.location.reload(true);
      })
      .catch((error) => {
        console.log(error);
      });
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
        columnId: columnId,
        _method: "PATCH",
      }
        axios.post(`/api/update-position/${id}`, data).then(response=>{
          console.log(response)
        }).catch(error=>{
            console.log(error)
        })
    },
    checkMove: function(e) {
      var cardId = e.dragged.attributes["data-id"].value;
      var columnId = e.to.attributes["data-id"].value;
      console.log(columnId)
      this.update(cardId, columnId)
      window.console.log("Future index: " + e.draggedContext.futureIndex);
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
    },
    editModal(id) {
      console.log(id)
      this.getCard(id);
    },
    getCard(id) {
      axios
        .get("/api/cards/" + id)
        .then((response) => {
          console.log(response)
          const { id, title } = response.data.card;
          this.editableCard.id = id;
          this.editableCard.title = title;
        }).catch((error) => {
          console.log(error);
        });
    },
    updateCard(id) {
      axios.post("/api/cards/"+this.editableCard.id, {
        title: this.editableCard.title,
        _method: "PUT",
      }).then((response) => {
        window.location.reload(true);
      }).catch((error) => {
        console.log(error);
      });
    },
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

.container {
  overflow-x: auto;
  width: 100%;
}
.scrollable-list {
  grid-template-columns: repeat(auto-fill, minmax(600px, 1fr));
  grid-gap: 10px;
  display: flex;
  flex-wrap: nowrap;
}

@media (max-width: 992px) {
  .container {
    overflow-y: auto;
  }
  .scrollable-list {
    grid-template-columns: repeat(1, 1fr);
    display: grid;
  }
}

</style>

