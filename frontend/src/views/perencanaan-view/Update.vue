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
                class="nav-link"
                aria-current="page"
                >Home</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'Index' }" class="nav-link active"
                >Kelola Rencana
              </router-link>
            </li>
          </ul>
          <button class="btn btn-outline-danger btn-sm" type="submit">
            Logout
          </button>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="ms-1 mt-2 mb-3">
        <h4>Create Rencana</h4>
      </div>
      <div class="row mt-2">
        <div class="col-md-12">
          <div class="card rounded shadow">
            <div class="card-body">
              <form @submit.prevent="update()">
                <div class="form-outline mb-3 mt-2">
                  <label>Rencana</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="perencanaan.rencana"
                  />
                </div>
                <div class="form-outline mb-3 mt-2">
                  <label>Deskripsi</label>
                  <textarea
                    v-model="perencanaan.deskripsi"
                    class="form-control"
                    id="floatingTextarea"
                  ></textarea>
                </div>
                <div class="form-outline mb-3 mt-2">
                  <label>Syarat</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="perencanaan.syarat"
                  />
                </div>
                <div class="form-outline mb-3 mt-2">
                  <label>Status</label>
                  <select
                    class="form-select"
                    aria-label="Default select example"
                    v-model="perencanaan.status"
                  >
                    <option value="Belum Tercapai" selected>
                      Belum Tercapai
                    </option>
                    <option value="Selesai">Selesai</option>
                  </select>
                </div>
                <div class="form-outline mb-3 mt-2">
                  <label>Target Waktu</label>
                  <input
                    type="date"
                    class="form-control"
                    v-model="perencanaan.target"
                  />
                </div>
                <div class="form-outline mb-3 mt-2">
                  <label>Biaya</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="perencanaan.biaya"
                  />
                </div>

                <button
                  type="submit"
                  class="btn btn-outline-success btn-block mt-3"
                >
                  Create
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";

export default {
  setup() {
    let perencanaan = reactive({
      rencana: "",
      deskripsi: "",
      status: "",
      syarat: "",
      biaya: "",
      target: "",
    });

    const validation = ref([]);
    const router = useRouter;
    const route = useRoute;

    onMounted(() => {
      axios
        .get(`http://127.0.0.1:8000/api/perencanaan/${route.params.id}`)
        .then((result) => {
          perencanaan.rencana = result.data.data.rencana;
          perencanaan.deskripsi = result.data.data.deskripsi;
          perencanaan.status = result.data.data.status;
          perencanaan.syarat = result.data.data.syarat;
          perencanaan.biaya = result.data.data.biaya;
          perencanaan.target = result.data.data.target;
        })
        .catch((err) => {
          console.log(err.response);
        });
    });

    function update() {
      axios
        .put(
          `http://127.0.0.1:8000/api/perencanaan/${route.params.id}`,
          perencanaan
        )
        .then(() => {
          router.push({ name: "Indedx" });
        })
        .catch((err) => {
          validation.value = err.response;
        });
    }

    return {
      perencanaan,
      validation,
      router,
      update,
    };
  },
};
</script>
