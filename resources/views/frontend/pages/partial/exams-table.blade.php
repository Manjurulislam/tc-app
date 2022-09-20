<table class="table" v-if="formModel.exams.length > 0">
    <thead>
    <tr>
        <th>Exam</th>
        <th>Year</th>
        <th>Roll</th>
        <th>Registration</th>
        <th>Session</th>
        <th>Center Name & Code</th>
        <th>Eiin</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for='(item, index) in formModel.exams' :key='index'>
        <td>
            @{{item.title}}
        </td>
        <td>
            <select class="custom-select-sm custom-select" v-model="formModel.exams[index].passing_year">
                <option v-for="year in schema.years" :key='index' :value="year">@{{year}}</option>
            </select>
        </td>
        <td>
            <input class="form-control form-control-sm" v-model="formModel.exams[index].roll">
        </td>
        <td><input class="form-control form-control-sm" v-model="formModel.exams[index].reg_no"></td>
        <td>
            <input class="form-control form-control-sm" v-model="formModel.exams[index].session">
        </td>
        <td><input class="form-control form-control-sm" v-model="formModel.exams[index].centre"></td>
        <td><input class="form-control form-control-sm" v-model="formModel.exams[index].eiin_no"></td>
    </tr>
    </tbody>
</table>
<span v-if="errors.exams" :class="['text-danger']">@{{ errors.exams[0] }}</span>
