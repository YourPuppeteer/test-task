const app = new Vue({
    el: "#app",
    data: {
        product: {
            type: '',
            size: '',
            weight: '',
            height: '',
            width: '',
            length: '',
        },
        selectedType: '',
    },
    watch: {
        selectedType: function (newType) {
            if (newType === 'DVD') {
                this.product = {type: 'DVD', size: '', weight: '', height: '', width: '', length: ''};
            } else if (newType === 'Book') {
                this.product = {type: 'Book', size: '', weight: '', height: '', width: '', length: ''};
            } else if (newType === 'Furniture') {
                this.product = {type: 'Furniture', size: '', weight: '', height: '', width: '', length: ''};
            }
        },
    },
});

