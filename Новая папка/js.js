const apiToken = "keyZIIVNiQPvozEWb"
const airTableApp = "appXJzFFs2zgj4X5C"
const airTableName = "Example"

new Vue({
  el: '#app',
  vuetify: new Vuetify({
      theme: {
          dark: true
      }
  }),
  data () {
    return {
        headers: [
            { text: 'Id', value: 'id' },
            { text: 'Name', value: 'Name' },
            { text: 'Details', value: 'details', sortable: false, width:"100" },
            { text: 'URL', value: 'url', name:'url', width:"180" },
            { text: 'Action', value: 'actions', sortable: false },
        ],
        items: [],
        dialog: false,
        editedItem: {}
    }
  },
  mounted() {
    this.loadItems()
  },
  methods: {
    showEditDialog(item) {
        this.editedItem = item||{}
        this.dialog = !this.dialog
    },
    loadItems() {
        this.items = []
        axios.get(`https://api.airtable.com/v0/${airTableApp}/${airTableName}`,
            { headers: { Authorization: "Bearer " + apiToken }})
        .then((response) => {
            this.items = response.data.records.map((item)=>{
                return {
                    id: item.id,
                    ...item.fields
                }
            })
        }).catch((error) => {
            console.log(error)
        })
    },
    saveItem(item) {
        /* this is used for both creating and updating API records
         the default method is POST for creating a new item */
         
        let method = "post"
        let url = `https://api.airtable.com/v0/${airTableApp}/${airTableName}`
        let id = item.id
        
        // airtable API needs the data to be placed in fields object
        let data = {
            fields: item
        }
        
        if (id) {
            // if the item has an id, we're updating an existing item
            method = "patch"
            url = `https://api.airtable.com/v0/${airTableApp}/${airTableName}/${id}`
            
            // must remove id from the data for airtable patch to work
            delete data.fields.id
        }

        // save the record
        axios[method](url,
            data,
            { headers: { 
                Authorization: "Bearer " + apiToken,
                "Content-Type": "application/json"
            }
        }).then((response) => {
            if (response.data && response.data.id) {
                console.log(response.data)
                // add new item to state
                this.editedItem.id = response.data.id
                if (!id) {
                    // add the new item to items state
                    this.items.push(this.editedItem)
                }
                this.editedItem = {}
            }
            this.dialog = !this.dialog
        })
    },
    deleteItem(item) {
        //console.log('deleteItem', item)
        let id = item.id
        let idx = this.items.findIndex(item => item.id===id)
        if (confirm('Are you sure you want to delete this?')) {
            /* not really deleting in API for demo */
            /*
            axios.delete(`https://api.airtable.com/v0/${airTableApp}/${airTableName}/${id}`,
                { headers: { 
                    Authorization: "Bearer " + apiToken,
                    "Content-Type": "application/json"
                }
            }).then((response) => {
                this.items.splice(idx, 1)
            })*/
            this.items.splice(idx, 1)
        }
    },
  }
})


