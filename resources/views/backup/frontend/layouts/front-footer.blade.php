<script>
    const BASE_URL = '{{URL::to('/')}}'
    new Vue({
        el: "#app",
        data: () => ({
            formModel: {
                student: {
                    religion: '',
                    gender: ''
                }
            },
            searchParams: {
                exam: '',
                year: '',
                rollNo: '',
                regNo: '',
                centerCode: '',
            },
            errors: [],
            loading: false,
        }),


        methods: {
            studentDetails() {
                let self = this;
                this.loading = true
                let route = BASE_URL + '/' + 'api/student';
                axios.post(route, this.searchParams).then(function ({data: {data}}) {
                    self.formModel.student = data;
                }).catch(function (error) {
                    if (error.response.status === 422) {
                        self.errors = error.response.data.errors;
                        console.log(self.errors)
                    } else {
                        console.log(error.response)
                    }
                }).finally(() => {
                    this.loading = false
                });
            },

        }
    });
</script>
