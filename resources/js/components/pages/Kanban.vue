<template>
    <div class="container">
        <!-- Top Navbar -->
        <TopNavbar />
        <!-- /Top Navbar -->
        <div class="wrapper">
            <div class="main section">
                <h1 class="text-center">Draggable Kanban Board</h1>
                <div class="row">
                    <div class="card col-lg-4 card-columns m-2" v-for="column in columns" :key="column.title" :id="column.id">
                        <div class="row justify-content-between mx-2 mt-2">
                            <div class="card-header float-left">{{ column.title }}</div>
                            <div class="">
                                <a class="btn btn-icon btn-sm btn-round btn-danger mr-2" @click="deleteColumn(column.id)"><i class="tim-icons icon-simple-remove"></i></a>
                                <button class="btn btn-icon btn-sm btn-round btn-succes" @click="showModal(column.id)" data-toggle="modal">
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
            <!-- Form Modal -->
            <div class="modal fade modal-black" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="tim-icons icon-simple-remove text-white"></i>
                    </button>
                    <div class="text-muted text-center ml-auto mr-auto">
                        <h3 class="mb-0">Sign in with</h3>
                    </div>
                    </div>
                    <div class="modal-body">
                    <div class="btn-wrapper text-center">
                        <a href="#" class="btn btn-neutral btn-icon">
                        <img src="assets/img/github.svg">
                        </a>
                        <a href="#" class="btn btn-neutral btn-icon">
                        <img src="assets/img/google.svg">
                        </a>
                    </div>
                    <div class="text-center text-muted mb-4 mt-3">
                        <small>Or sign in with credentials</small>
                    </div>
                    <form role="form">
                        <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </span>
                            </div>
                            <input class="form-control" placeholder="Email" type="email">
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="tim-icons icon-key-25"></i>
                            </span>
                            </div>
                            <input class="form-control" placeholder="Password" type="password">
                        </div>
                        </div>
                        <div class="form-check mt-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" checked>
                            <span class="form-check-sign"></span>
                            Remember me!
                        </label>
                        </div>
                        <div class="text-center">
                        <button type="button" class="btn btn-primary my-4">Sign in</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            <!--  End Modal -->
            <!--Footer-->
            <Footer />
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
        'decription': '',
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
    // createNewCard(){
    //   axios.post("/cards/", {
    //     card: this.card,
    //     _method: "POST",
    //   });
    //   this.getColumns();
    // },
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
    showModal(id) {
        window.$('#myModal2').modal('show');
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
</style>

