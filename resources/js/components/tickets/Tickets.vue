<template>
<div>
    <div class="card mt-1">
        <div class="card-body">
            <div  v-if="!showAddingForm" class="d-flex justify-content-between">
                <div></div>
                <div>
                    <button class="btn btn-sm btn-warning" @click="showAddingForm=true">ارسال پاسخ</button>

                </div>
            </div>
            <form @submit.prevent="addAnswer" v-if="showAddingForm" class="form">
<!--                <div class="h3 mb-3">-->
<!--                    ثبت تیکت جدید-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="department" class="form-label">مربوط به دپارتمان</label>-->
<!--                    <select class="form-select" id="department" aria-label="department" aria-describedby="departmentHelp">-->
<!--                        <option selected>Open this select menu</option>-->
<!--                        <option value="1">One</option>-->
<!--                        <option value="2">Two</option>-->
<!--                        <option value="3">Three</option>-->
<!--                    </select>-->
<!--                    <div id="departmentHelp" class="form-text">مثال: مشکل در بارگزاری تصاویر</div>-->
<!--                </div>-->

<!--                <div class="mb-3">-->
<!--                    <label for="title" class="form-label">عنوان تیکت</label>-->
<!--                    <input type="text" class="form-control" id="title" aria-describedby="titleHelp">-->
<!--                    <div id="titleHelp" class="form-text">مثال: مشکل در بارگزاری تصاویر</div>-->
<!--                </div>-->

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
        </div>
        </div>
    <div class="card mt-1"  v-if="!showAddingForm">
        <div class="card-body">
            <div v-for="answer in answers">
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
                    <span>نقی احمدی</span>
                </div>
                <div class="mb-2 text-start">
                    <div class="d-inline-block px-3 py-1 bg-success text-light" style="border-radius: 0 15px 15px 15px">
                        <span class="text-sm">{{answer.body}}</span>
                    </div>
                </div>
            </div>
            </div>
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
        'department_id'
    ],
    data(){
        return{
            showAddingForm:false,
            body:'',
            answers:[]
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

            axios.post('/v/ticket/answers/add/',
                {
                    user_id: this.user.id,
                    project_id: this.project_id,
                    reply_to: this.ticket_id,
                    department_id: this.department_id,
                    body: this.body
                },
                {}).then(response => {
                    this.answer = '';
                    this.answers = response.data;
                    this.showAddingForm=false
            }
        );

        },
    }
}
</script>

<style scoped>

</style>
