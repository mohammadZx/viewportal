<template>
    <div class="variable-management">

        <ul class="list-group mt-3">
            <li class="list-group-item" v-for="item in datas">
                <div class="row">
                    <div class="col-md-6">نام: {{item.name}}</div>
                    <div class="col-md-6">توضیحات: {{item.content}}</div>
                    <div class="col-md-6">هزینه: {{item.price}}</div>
                    <div class="col-md-6">
                        <a @click.stop.prevent="deleteItem(item.id)" class="btn-sm btn-danger">&#10006;</a>
                    </div>
                </div>
            </li>
        </ul>


        <form action="" @submit.stop.prevent="send">
            <ul class="err-box">
                <li class="error" v-for="error in v_get_errors()" :key="error">{{error}}</li>
            </ul>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">نام*</label>
                        <input required type="text" class="form-control" name="name" v-model="data.name" id="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">قیمت*</label>
                        <input required type="number" class="form-control" name="price" v-model="data.price" id="price">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="content">توضیحات</label>
                        <textarea name="content" id="content" class="form-control" v-model="data.content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="commissiontype">پورسانت سایت*</label>
                        <select required name="commissiontype" class="form-control" v-model="data.commission_type" id="commissiontype">
                            <option value="percent">درصدی</option>
                            <option value="static">ثابت</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference">ارجاع*</label>
                        <input required type="number" class="form-control" name="reference" v-model="data.reference" id="reference">
                    </div>
                    <div class="form-group">
                        <label for="commission">پورسانت سایت*</label>
                        <input required type="number" class="form-control" name="commission" v-model="data.site_commission" id="commission">
                    </div>
                    <button class="btn btn-primary btn-sm">ثبت</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "variableManagement",
    data() {
        return{
            option: document.querySelector('#edit-option').getAttribute('data-option'),
            token: window.csrftoken,
            datas: {},
            data: {
                name: "تک کارشناس",
                content: null,
                reference: 1,
                price: null,
                site_commission: 30,
                commission_type : "percent",
                option: document.querySelector('#edit-option').getAttribute('data-option'),
            },
            selected: null
        }
    },
    mounted(){
        this.getData();
    },
    methods: {
        getData(){
            axios.get(`/api/v1/option/${this.option}/vars`)
            .then(res => {
                this.datas = res.data
            })
        },
        send(){
            this.vr(this.data.name, 'نام');
            this.vr(this.data.reference, 'ارجاع');
            this.vr(this.data.price, 'قیمت');
            this.vr(this.data.site_commission, 'پورسانت سایت');
            this.vr(this.data.commission_type, 'نوع پورسانت');
            if(!this.v_error_check()) return;

            axios.post('/api/v1/vars', this.data)
            .then(res => {
              this.getData()  
            })
            this.reset()
        },
        deleteItem(id){
           axios.delete(`/api/v1/vars/${id}`, {_token: this.token})
            .then(res => {
                this.getData()
            }) 
        },
        reset(){
            this.data = {
                name: "",
                content: null,
                reference: 1,
                price: null,
                site_commission: 30,
                commission_type : "percent",
                option: document.querySelector('#edit-option').getAttribute('data-option'),
            }
        }
    }
}
</script>