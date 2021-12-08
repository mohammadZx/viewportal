<template>
    <div class="col-md-6">
        <form action="" method="post" @submit="submitform($event)" class="send-question" data-jsonvars="">
            <input type="hidden" name="_token" :value="token">
            <div class="form-group">
                <label for="option">نوع درخواست</label>
                <select required name="option" id="option" v-model="selectedoptionId" @change="changeSelectedOption();calcPrice();removeDiscount();" class="form-control">
                    <option value="0">نوع درخواست</option>
                    <option v-for="option in options" :value="option.id">{{option.name}}</option>
                </select>
                <div :class="[optionmessage ? 'active' : null]" class="mt-2 unactive alert alert-sm alert-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="message">{{optionmessage}}</span></div>
            </div>
            <div class="form-group">
                <label for="option_type">سطح درخواست</label>
                <select @change="changeType();calcPrice();removeDiscount();" v-model="selectedType" name="type" id="option_type" class="form-control" required>
                    <option value="0">سطح درخواست</option>
                    <option v-for="type in types" :value="type.id">{{type.name}} ({{type.price}} تومان)</option>
                </select>
                <div :class="[typemessage ? 'active' : null]" class="mt-2 unactive alert alert-sm alert-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="message">{{typemessage}}</span></div>
            </div>
            <div class="form-group">
                <label for="option_var">نوع بررسی</label>
                <select @change="changeVar();calcPrice();removeDiscount();" v-model="selectedVar" name="var" id="option_var" class="form-control" required>
                    <option value="0">نوع بررسی</option>
                    <option v-for="vart in vars" :value="vart.id">{{vart.name}} ({{vart.price}} تومان)</option>
                </select>
                <div :class="[varmessage ? 'active' : null]" class="mt-2 unactive alert alert-sm alert-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="message">{{varmessage}}</span></div>
            </div>
            <div class="form-group">
                <label for="coupon">کد تخفیف: </label>
                <input v-model="discountCode" type="text" name="coupon" id="coupon" class="form-control">
                <div :class="[discountMessage.length ? 'active ' + this.discountStatus : null]" class="mt-2 unactive alert alert-sm"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="message" v-for="n in discountMessage">{{n}}</span></div>
                <button type="button" @click="sendDisacount();" class="mt-2 btn btn-primary btn-sm">محاصبه تخفیف</button>
            </div>

            <div class="form-group">
                <div class="discount-status" v-if="this.discountStatus == 'alert-success'">
                    <p>کد تخفیف: {{this.discountCode}} <i class="fa fa-window-close" @click="removeDiscount();calcPrice()"></i></p>
                    <p>مقدار هزینه کد تخفیف: {{this.discountedPrice}}</p>
                </div>
                <button class="btn btn-danger btn-sm" id="showprice" type="button">هزینه کل: <span class="price">{{allPrice}}</span></button>
            </div>
            <div v-if="userwallet >= allPrice" class="form-group">
                <label for="wallet">پرداخت با کیف پول: </label>
                <input type="checkbox" name="gateway" v-model="gateway" value="wallet" id="wallet">
            </div>

            <div v-if="gateway == false">
                <input type="hidden" name="gateway" value="zarinpal">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-sm">ثبت و پرداخت</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: "sendquestion",
    data() {
        return{
            token: window.csrftoken,
            gateway: false,
            userwallet: window.userwallet,
            options: {},
            selectedoptionId: 0,
            optionmessage: null,
            
            types: {},
            selectedType: 0,
            typemessage: null,

            vars: {},
            selectedVar: 0,
            varmessage: null,


            allPrice: 0,
            discountedPrice: 0,
            discountCode: null,
            discountStatus: 'alert-',
            discountMessage: []
        }
    },
     mounted(){
         axios.get('/api/v1/get-options')
         .then(res => {
             this.options = res.data
             console.log(res.data);
         }) 
    },
    methods: {
        changeSelectedOption(){
            this.backToDefault();
            if(this.selectedoptionId == 0) return;
            this.types = this.options.find(x => x.id == this.selectedoptionId).types
            this.vars = this.options.find(x => x.id == this.selectedoptionId).vars
            this.optionmessage = this.options.find(x => x.id == this.selectedoptionId).content
        },
        changeType(){
            if(this.selectedType == 0){
                this.typemessage = null
                return;
            }
            this.typemessage = this.types.find(x => x.id == this.selectedType).content
        },
        changeVar(){
            if(this.selectedVar == 0){
                this.varmessage = null
                return
            }
            this.varmessage = this.vars.find(x => x.id == this.selectedVar).content
        },
        backToDefault(){
                this.types = {}
                this.vars = {}
                this.selectedType = 0
                this.selectedVar = 0
                this.optionmessage = null
                this.typemessage = null
                this.varmessage = null
        },
        calcPrice(){
           this.allPrice = 0;
           this.allPrice += this.selectedVar != 0 ? this.vars.find(x => x.id == this.selectedVar).price : 0
           this.allPrice += this.selectedType != 0 ? this.types.find(x => x.id == this.selectedType).price : 0
           this.allPrice -= this.discountedPrice;
        },
        sendDisacount(){
            this.discountStatus = "alert-"
            if(this.selectedoptionId == 0 || this.selectedType == 0 || this.selectedVar == 0){
                this.discountStatus = "alert-warning";
                this.discountMessage = 'لطفا گزینه هارا انتخاب نمایید'
                return;
            }
            axios.post('/api/v1/question/setdiscount', {
                selectedType: this.selectedType,
                selectedOption: this.selectedoptionId,
                selectedVar: this.selectedVar,
                discountCode: this.discountCode,
            }).then(res => {
                this.discountedPrice = Math.round(res.data.discount_price)
                this.discountMessage = res.data.messages
                this.discountStatus  = this.discountStatus + res.data.type
                this.calcPrice();
            })
        },
        removeDiscount(){
            this.discountedPrice= 0
            this.discountCode= null
            this.discountStatus= 'alert-'
            this.discountMessage= []
            this.calcPrice()
        },
        submitform(ev){
           if(this.selectedoptionId == 0 || this.selectedType == 0 || this.selectedVar == 0){
               ev.preventDefault();
           }
        }
    }
}
</script>
