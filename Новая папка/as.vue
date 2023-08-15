
<template>
    <div>
      <v-data-table
        :headers="headers"
        :items="users"
        mobile-breakpoint="800"
        class="elevation-0"
      >
      <template v-slot:[`item.actions`]="{ item }">
                          <div class="text-truncate">
                            <v-icon
                              small
                              class="mr-2"
                              @click="showEditDialog(item)"
                              color="primary" 
                            >
                              mdi-pencil
                            </v-icon>
                            <v-icon
                              small
                              @click="deleteItem(item)"
                              color="pink" 
                            >
                              mdi-delete
                            </v-icon>
                        </div>
                      </template>
                      <template v-slot:[`item.details`]="{ item }">
                          <div class="text-truncate" style="width: 180px">
                              {{item.Details}}
                          </div>
                      </template>
                      <template v-slot:[`item.url`]="{ item }">
                          <div class="text-truncate" style="width: 180px">
                              <a :href="item.URL" target="_new">{{item.URL}}</a>
                          </div>
                      </template>
    
    </v-data-table>
    <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                      <div class="d-flex">
                          <v-btn color="primary" dark class="ml-auto ma-3" v-on="on">
                              New 
                              <v-icon small>mdi-plus-circle-outline</v-icon>
                          </v-btn>
                      </div>
                    </template>
                    <v-card>
                      <v-card-title>
                          <span v-if="editedItem.id">Edit {{editedItem.id}}</span>
                          <span v-else>Create</span>
                      </v-card-title>
                      <v-card-text>
                          <v-row>
                            <v-col cols="12" sm="4">
                              <v-text-field v-model="editedItem.Name" label="Name"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="8">
                              <v-text-field v-model="editedItem.Details" label="Details"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12">
                              <v-text-field v-model="editedItem.URL" label="URL"></v-text-field>
                            </v-col>
                          </v-row>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="showEditDialog()">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="saveItem(editedItem)">Save</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
    </div>
  </template>
  