<<template>
    <div>
        <div id="infomation">
            <div class="card">
                <div class="card-header" id="headingInformation" data-toggle="collapse" data-target="#collapseInformation" aria-expanded="true" aria-controls="collapseInformation">
                    <h5 class="mb-0">
                        Infomation
                    </h5>
                </div>
                <div id="collapseInformation" class="collapse show" aria-labelledby="headingInformation" data-parent="#infomation">
                    <div class="card-body">
                        <info-user :info="user"></info-user>
                    </div>
                </div>
            </div>
        </div>
        <!-- View Order -->
        <div id="order">
            <div class="card">
                <div class="card-header" id="headingOrder" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="false" aria-controls="collapseOrder">
                    <h5 class="mb-0">
                        Order
                    </h5>
                </div>
                <div id="collapseOrder" class="collapse show" aria-labelledby="headingOrder" data-parent="#order">
                    <div class="card-body">
                        <user-order></user-order>
                    </div>
                </div>
            </div>
        </div>
        <!-- Activity -->
        <div id="activity">
            <div class="card">
                <div class="card-header" id="headingActivity" data-toggle="collapse" data-target="#collapseActivity" aria-expanded="false" aria-controls="collapseActivity">
                    <h5 class="mb-0">
                        Activity
                    </h5>
                </div>
                <div id="collapseActivity" class="collapse show" aria-labelledby="headingActivity" data-parent="#activity">
                    <div class="card-body">
                        <user-activity :data="user"></user-activity>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import UserOrder from './UserOrder.vue'
    import InfoUser from './InfoUser.vue'
    import UserActivity from './UserActivity.vue'

    export default {
        props:['user'],
        components:{UserOrder,InfoUser,UserActivity}
    }
</script>
