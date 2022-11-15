<template>
  <div class="">
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid shadow pt-2 pb-3">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-4" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link
                :to="{ name: 'Home' }"
                class="nav-link active"
                aria-current="page"
                >Home</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'Index' }" class="nav-link"
                >Kelola Rencana</router-link
              >
            </li>
          </ul>
          <a
            @click="logout"
            class="btn btn-outline-danger btn-sm"
            type="button"
          >
            Logout
          </a>
        </div>
      </div>
    </nav>
    <div class="px-4">
      <div class="card p-3 mt-3">
        <h2>Hallo, Selamat Datang</h2>
        <h4>Rencanakan Harimu/Targetmu dengan Matang!!!</h4>
        <div class="mt-2">
          <router-link :to="{ name: 'Create' }" class="btn btn-success"
            >Buat Rencana</router-link
          >
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-header p-2"><h5>Daftar Rencanamu</h5></div>
        <div class="card-body">
          <div class="row">
            <div
              class="col-md-6 col-lg-12 mb-1"
              v-for="(perencanaan, index) in perencanaans.data"
              :key="index"
            >
              <div class="card border-primary p-2">
                <div class="row">
                  <div class="col-md-9 col-lg-11">
                    <div class="row">
                      <div class="col-md-4">
                        <small>Rencana :</small>
                        <h5>{{ perencanaan.rencana }}</h5>
                      </div>
                      <div class="col-md-3">
                        <small>Status :</small>
                        <h5>{{ perencanaan.status }}</h5>
                      </div>
                      <div class="col-md-2">
                        <small>Biaya :</small>
                        <h5>{{ perencanaan.biaya }}</h5>
                      </div>
                      <div class="col-md-2">
                        <small>Waktu Target :</small>
                        <h6>{{ perencanaan.target }}</h6>
                      </div>
                    </div>
                    <div>
                      <small>Deskripsi: </small>
                      <p>
                        {{ perencanaan.deskripsi }}
                      </p>
                    </div>
                    <div>
                      <small>syarat: </small>
                      <p>
                        {{ perencanaan.syarat }}
                      </p>
                    </div>
                  </div>
                  <div class="col-md-3 col-lg-1 d-flex align-items-center">
                    <button
                      class="btn btn-outline-success btn-sm"
                      @click.prevent="destroy(perencanaan.id, index)"
                    >
                      Selesai
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { useStore } from "vuex";
import { computed, onMounted, ref } from "vue";
import { useRouter } from "vue-router";

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    let perencanaans = ref([]);

    onMounted(() => {
      axios
        .get("http://127.0.0.1:8000/api/perencanaan/")
        .then((result) => {
          perencanaans.value = result.data;
        })
        .catch((err) => {
          console.log(err.response);
        });
    });

    function logout() {
      store.dispatch("logout").then(() => {
        router.push({
          name: "Login",
        });
      });
    }
    function destroy(id, index) {
      axios
        .delete(`http://127.0.0.1:8000/api/perencanaan/${id}`)
        .then(() => {
          perencanaans.value.data.splice(index, 1);
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    }

    return {
      user: computed(() => store.state.user.data),
      logout,
      perencanaans,
      destroy,
    };
  },
};
</script>
