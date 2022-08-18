<template>
<div>
    <el-form label-width="100px">
        <div class="form-item">
            <el-form-item label="Add Event Category">
                <el-col>
                    <el-input type="text" size="large" v-model="eventCategory.title" />
                </el-col>
            </el-form-item>
        </div>
        <div>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">{{ eventCategory.button }}</el-button>
            </el-form-item>
        </div>
    </el-form>

</div>
</template>

<script>
export default {

    props: ['eventCategory'],
    emits: ["form-submit"],
    methods: {

        onSubmit() {
            this.$emit("form-submit", this.eventCategory);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
