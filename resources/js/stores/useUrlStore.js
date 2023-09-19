import { defineStore } from "pinia";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useUrlStore = defineStore("urls", {
    state: () => ({
        Urls: [],
        mostVisitedUrls: [],
        errors: null,
        Url: {
            data: {
                full_link: "",
                name_link: "",
            },
        },
    }),
    getters: {
        getUrls: (state) => state.Urls,
        getErrors: (state) => state.errors,
        getmostVisitedUrls: (state) => state.mostVisitedUrls,
    },
    actions: {
        async AddUrls(user_id) {
            try {
                const response = await axios.post("/api/storeUrl", {
                    full_link: this.Url.data.full_link,
                    name_link: this.Url.data.name_link,
                    user_id,
                });
                this.Urls.unshift(response.data);
                this.mostVisitedUrls.unshift(response.data);
                this.Url = {
                    data: {
                        full_link: "",
                        name_link: "",
                    },
                };
                this.errors = null;
                toast.success("Your url has been added successfully! ✔");
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                toast.warning("Oops !! something wrong? 🤔");
            }
        },
        //fetch data from backend
        async fetchUrls(user_id) {
            try {
                const response = await axios.get(`/api/displayUrls/${user_id}`);
                this.Urls = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        //delete the item
        async deleteUrl(url_id, user_id) {
            try {
                //message confirmation
                if (
                    window.confirm("Are you sure you want to delete this URL ?")
                ) {
                    await axios.delete(`/api/deleteUrls/${url_id}`);
                }
                this.fetchUrls(user_id);
                this.fetchMostVisitedUrls(user_id);
                toast.error("URL successfully deleted!");
            } catch (error) {
                console.log(error);
            }
        },
        //most visted Urls
        async fetchMostVisitedUrls(user_id) {
            try {
                const response = await axios.get(
                    `/api/mostVisitedUrls/${user_id}`
                );
                this.mostVisitedUrls = response.data;
            } catch (error) {
                console.log(error);
            }
        },
    },
});
