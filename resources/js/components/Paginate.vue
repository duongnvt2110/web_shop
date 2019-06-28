<template>
    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link"
                v-show="! (paginate.current_page <= 1)"
                @click.prevent="fetch(paginate.current_page-1)">Previous
            </a>
        </li>
        <li class="page-item">
            <a class="page-link"
                v-show="! (paginate.current_page===paginate.last_page)"
                v-text="paginate.current_page">
                </a>
        </li>
        <li class="page-item">
            <a class="page-link"
                v-show="! (paginate.current_page === paginate.last_page)"
                v-text="paginate.current_page+1"
                @click.prevent="fetch(paginate.current_page+1)">
            </a>
        </li>
        <li class="page-item">
            <a class="page-link"
                v-show=" (paginate.current_page < paginate.last_page)"
                @click.prevent="fetch(paginate.current_page+1)">Next
            </a>
        </li>
    </ul>
    </nav>
</template>
<script>
    export default {

        props:['paginate'],
        methods:{
            fetch(page){
                 if(page <= this.paginate.last_page){
                    history.pushState(null, null, location.pathname+'?page=' + page);
                    this.$emit('paginate',page);

                }else{
                    flash('Not value');
                }
            },
            getPage(){
                var reg =/(\d+)/g;
                var page = reg.exec(location.href);
                return page[0];
            }
        }
    }
</script>
