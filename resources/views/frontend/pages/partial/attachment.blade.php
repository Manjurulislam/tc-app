<table class="table table-sm">
    <tr>
        <th class="text-right">জন্ম সনদ</th>
        <td>
            <label class="btn btn-primary" for="birth">
                <input id="birth" type="file" class="d-none" ref="birth" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.birthCert"> @{{attachments.birthCert.name}}</span>
            <span v-if="errors.birthCert" :class="['text-danger']">@{{ errors.birthCert[0] }}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">প্রাইমারী স্কুল পাসের সনদ( প্রযোজ্য ক্ষেত্রে )</th>
        <td>
            <label class="btn btn-primary" for="primaryCer">
                <input id="primaryCer" type="file" class="d-none" ref="primaryCer" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.primaryCert"> @{{attachments.primaryCert.name}}</span>
            <span v-if="errors.primaryCert" :class="['text-danger']">@{{ errors.primaryCert[0] }}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">প্রতিষ্ঠান প্রধানের প্রত্যয়নপত্র</th>
        <td>
            <label class="btn btn-primary" for="testimonial">
                <input id="testimonial" type="file" class="d-none" ref="testimonial" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.testimonialCert"> @{{attachments.testimonialCert.name}}</span>
            <span v-if="errors.testimonialCert" :class="['text-danger']">@{{ errors.testimonialCert[0] }}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">জাতীয় পরিচয়পত্র / জন্ম সনদ</th>
        <td>
            <label class="btn btn-primary" for="nid">
                <input id="nid" type="file" class="d-none" ref="nid" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.nidCert"> @{{attachments.nidCert.name}}</span>
            <span v-if="errors.nidCert" :class="['text-danger']">@{{ errors.nidCert[0] }}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">এফিডেভিট ( প্রযোজ্য ক্ষেত্রে )</th>
        <td>
            <label class="btn btn-primary" for="afid">
                <input id="afid" type="file" class="d-none" ref="afid" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.afidCert"> @{{attachments.afidCert.name}}</span>
            <span v-if="errors.afidCert" :class="['text-danger']">@{{ errors.afidCert[0] }}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">অন্যান্য</th>
        <td>
            <label class="btn btn-primary" for="extra">
                <input id="extra" type="file" class="d-none" ref="extra" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.extraCert"> @{{attachments.extraCert.name}}</span>
        </td>
    </tr>
    <tr>
        <th class="text-right">জাতীয় পরিচয়পত্র ( নিজ/পিতা/মাতা যেটা প্রয়োজন )</th>
        <td>
            <label class="btn btn-primary" for="nidGuardian">
                <input id="nidGuardian" type="file" class="d-none" ref="nidGuardian" @change="onFileChange">
                Browse
            </label>
            <br>
            <span v-if="attachments.nidGuardianCert"> @{{attachments.nidGuardianCert.name}}</span>
            <span v-if="errors.nidGuardianCert" :class="['text-danger']">@{{ errors.nidGuardianCert[0] }}</span>
        </td>
    </tr>
</table>
