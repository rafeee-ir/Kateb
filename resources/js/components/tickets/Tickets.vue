<template>
<div>
    <div class="card mt-3">
        <div class="card-body">
            <div  v-if="!showAddingForm" class="d-flex justify-content-between">
                <div>
                    <button v-if="showDoneBtn" class="btn btn-sm btn-primary" @click="showAddingForm=true">ارسال پاسخ</button>
                    <button v-if="!showDoneBtn" class="btn btn-sm btn-warning" @click="showAddingForm=true">باز کردن تیکت</button>
<!--                    <span class="badge bg-secondary" v-if="answers.length>0">{{answers.length}}</span>-->
<!--                    <span class=" " v-if="answers.length>0">پاسخ</span>-->
                </div>
                <div>
                    <button  v-if="showDoneBtn&&!showAddingForm" @click="doneAnswer" class="btn btn-sm btn-outline-warning text-dark">بستن تیکت</button>

                </div>
            </div>
            <form @submit="addAnswer" v-if="showAddingForm" class="form">
                <div class="mb-3">
                    <label for="body" class="form-label">پاسخ</label>
                    <textarea class="form-control" id="body" name="body" v-model="body" rows="3"></textarea>
                </div>
<!--                <div class="mb-3">-->
<!--                    <label for="file" class="form-label">فایل (اختیاری)</label>-->
<!--                    <input class="form-control" type="file" id="file" disabled>-->
<!--                </div>-->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success" type="submit">ثبت پاسخ</button>
                    <button class="btn btn-outline-secondary" type="reset" @click="showAddingForm=false">انصراف</button>
                </div>
            </form>
            <div class="mt-3" v-for="answer in answers" v-if="!showAddingForm&&answers.length>0">
            <div v-if="answer.user_id===ticket_user_id">
                <div class="text-sm text-muted">
                <span>{{user.name}}</span>
                <span class="badge bg-light text-secondary rounded-pill">{{answer.when}}</span>
            </div>
                <div class="mb-2">
                    <div class="d-inline-block px-3 py-1" style="border-radius: 15px 0 15px 15px;background: #eee">
                        <span class="text-sm">{{answer.body}}</span>
                    </div>
                </div>
            </div>

            <div v-else>
                <div class="text-sm text-muted text-start">
                    <span class="badge bg-light text-secondary rounded-pill">{{answer.when}}</span>
                    <span></span>
                </div>
                <div class="mb-2 text-start">
                    <div class="d-inline-block px-3 py-1 bg-success text-light" style="border-radius: 0 15px 15px 15px">
                        <span class="text-sm">{{answer.body}}</span>
                    </div>
                </div>
            </div>
            </div>

<!--            <div  v-if="showDoneBtn&&!showAddingForm" class="d-flex justify-content-between">-->
<!--                <div></div>-->
<!--                <div>-->
<!--                    <button  v-if="showDoneBtn&&!showAddingForm" @click="doneAnswer" class="btn btn-sm btn-outline-warning">بستن تیکت</button>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Tickets",
    props:[
        'user',
        'ticket_id',
        'ticket_user_id',
        'project_id',
        'department_id',
    ],
    data(){
        return{
            showAddingForm:false,
            body:'',
            answers:[],
            showDoneBtn:true
        }
    },
    mounted() {
        this.getAnswers()
    },
    methods: {
        getAnswers(){
            axios.get('/v/ticket/answers/'+this.ticket_id)
                .then(response => {
                    this.answers = response.data
                });
        },
        addAnswer() {
            this.showAddingForm=false;
            axios.post('/v/ticket/answers/add/',
                {
                    user_id: this.user.id,
                    project_id: this.project_id,
                    reply_to: this.ticket_id,
                    department_id: this.department_id,
                    body: this.body
                },
                {}).then(response => {
                this.showAddingForm=false;
                    this.answer = '';
                    this.answers = response.data;

                }
        )},
        doneAnswer() {
            axios.post('/v/ticket/answers/done/',
                {
                    user_id: this.user.id,
                    project_id: this.project_id,
                    reply_to: this.ticket_id,
                    department_id: this.department_id,
                    body: 'تیکت بسته شد'
                },
                {}).then(response => {
                    this.showDoneBtn=false;
                    this.answer = '';
                    this.answers = response.data;
                    this.showAddingForm=false
            }
        )},
    }
}
</script>

<style scoped>

</style>
