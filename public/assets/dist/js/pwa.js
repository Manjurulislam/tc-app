new Vue({
    el: "#app",
    data: () => ({
        formModel: {
            name: '',
            religion: '',
            gender: '',
            correction_religion: '',
            correction_gender: '',
            exams: [],
        },

        attachments: {
            birthCert: null,
            primaryCert: null,
            testimonialCert: null,
            nidCert: null,
            afidCert: null,
            extraCert: null,
            nidGuardianCert: null,
            photo: null,
        },

        primaryCert: null,


        schema: {
            exams: [],
            years: [],
            correction: []
        },

        searchParams: {
            exam: '',
            year: '',
            rollNo: '',
            regNo: '',
            centerCode: [],
        },
        errors: [],
        selectedExamId: [],
        correctionError: '',
        correctionExamError: '',
        loading: false,
        btnLoading: false,
        statusStudent: false,
        notification: '',
        photoUrl: ''
    }),


    methods: {
        studentDetails() {
            let self = this;
            this.loading = true
            let route = BASE_URL + '/' + 'api/student';
            axios.post(route, this.searchParams).then(function ({data: data}) {
                if (data.status === 200) {
                    let {exams, years, student} = data.data;
                    self.formModel = student;
                    self.schema.years = years;
                    self.loading = false;
                    self.statusStudent = false
                    self.errors = [];
                    self.examSelected(exams);
                    document.getElementById("myDiv").style.display = "block";
                } else {
                    self.statusStudent = true
                }
            }).catch(function (error) {
                if (error.response.status === 422) {
                    self.errors = error.response.data.errors;
                    self.loading = false
                    document.getElementById("search-error").removeAttribute("hidden");
                } else {
                    console.log(error.response)
                    self.statusStudent = true
                }
            }).finally(() => {
                this.loading = false
            });
        },

        examSelected(exam) {
            let self = this;
            let obj = exam.find(item => item.title === self.formModel.exam);
            this.selectedExamId.push(obj.id);

            this.formModel.exams = exam.map(item => (
                {
                    id: item.id,
                    title: item.title,
                    passing_year: self.formModel.exam === item.title ? self.formModel.year : '',
                    roll: self.formModel.exam === item.title ? self.formModel.roll : '',
                    reg_no: self.formModel.exam === item.title ? self.formModel.reg_no : '',
                    session: self.formModel.exam === item.title ? self.formModel.session : '',
                    centre: '',
                    eiin_no: self.formModel.exam === item.title ? self.formModel.eiin_no : '',
                }
            ));
        },


        onFileChange() {
            this.attachments.birthCert = this.$refs.birth.files[0];
            this.attachments.primaryCert = this.$refs.primaryCer.files[0];
            this.attachments.testimonialCert = this.$refs.testimonial.files[0];
            this.attachments.nidCert = this.$refs.nid.files[0];
            this.attachments.afidCert = this.$refs.afid.files[0];
            this.attachments.extraCert = this.$refs.extra.files[0];
            this.attachments.nidGuardianCert = this.$refs.nidGuardian.files[0];
            this.attachments.photo = this.$refs.photo.files[0];
            this.photoUrl = URL.createObjectURL(this.attachments.photo);
        },


        storeData() {
            let self = this;
            let route = BASE_URL + '/' + 'application';
            this.formModel.exam_id = this.selectedExamId;

            if (this.schema.correction.length === 0) {
                this.notification = 'Select an item what is need to you correction';
                this.correctionError = 'Select an item what is need to you correction';
                return false
            }

            if (this.selectedExamId.length === 0) {
                this.notification = 'Select exam what is need to you correction'
                this.correctionExamError = 'Select exam what is need to you correction'
                return false
            }

            this.btnLoading = true;
            let obj = this.formModel;
            let formData = new FormData();
            formData.append('birthCert', self.attachments.birthCert);
            formData.append('primaryCert', self.attachments.primaryCert);
            formData.append('testimonialCert', self.attachments.testimonialCert);
            formData.append('nidCert', self.attachments.nidCert);
            formData.append('afidCert', self.attachments.afidCert);
            formData.append('extraCert', self.attachments.extraCert);
            formData.append('nidGuardianCert', self.attachments.nidGuardianCert);
            formData.append('photo', self.attachments.photo);
            formData.append('correctionExams', JSON.stringify(self.formModel.exams));
            formData.append('selectedExam', JSON.stringify(self.formModel.exam_id));

            Object.keys(obj).forEach(function (key) {
                if (key === 'exams') {
                    delete key;
                }
                formData.append(key, obj[key])
            });

            axios.post(route, formData).then(function ({data: data}) {
                if (data.status === 200) {
                    self.notification = data.message;
                    self.btnLoading = false;
                    alertify.success(data.message);
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                } else {
                    alertify.error(data.message);
                    self.notification = data.message;
                }
            }).catch(function (error) {
                if (error.response.status === 422) {
                    self.errors = error.response.data.errors;
                } else {
                    console.log(error.response)
                }
            }).finally(() => {
                this.btnLoading = false;
            });
        },


    }
});
