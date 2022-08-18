<template>
<div>
    <!-- <el-card class="box-card"> -->
    <el-form label-width="100px">
        <div class="form-item">
            <el-form-item label="Name">
                <el-col>
                    <el-input type="text" size="large" v-model="eventOrganizer.name" />
                </el-col>
            </el-form-item>
            <el-form-item label="Details">
                <el-col>
                    <el-input type="textarea" v-model="eventOrganizer.details" />
                </el-col>
            </el-form-item>
        </div>
        <div>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">{{ eventOrganizer.button }}</el-button>
            </el-form-item>
        </div>
    </el-form>
    <!-- </el-card> -->

</div>
</template>

<script>
export default {

    props: ['eventOrganizer'],
    emits: ["form-submit"],
    methods: {

        onSubmit() {
            this.$emit("form-submit", this.eventOrganizer);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
