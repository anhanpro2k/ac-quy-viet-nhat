export default function DatePickerModule() {
    let tomorrow = new Date(new Date().valueOf() + 1000 * 3600 * 24);
    let tomorrow_after = new Date(new Date().valueOf() + 2000 * 3600 * 24);
    let today = new Date();
    const openTimePicker = document.querySelector(".openTimePicker.input");
    $(".openTimePicker").daterangepicker({
        minDate: today,
        autoApply: true,
        autoUpdateInput: true,
        timePicker: false,
        alwaysShowCalendars: true,
        singleDatePicker: true,
        startDate: moment().startOf("hour"),
        locale: {
            format: "DD/MM/YYYY",
            separator: " - "
        }
    });
    $(".openTimePicker").on("apply.daterangepicker", function(ev, picker) {
        console.log(picker.startDate.format("DD/MM/YYYY"));
        openTimePicker.value = picker.startDate.format("DD/MM/YYYY");
        openTimePicker.setAttribute(
            "data-time",
            picker.startDate.format("DD/MM/YYYY")
        );
        $(".openTimePicker").html(picker.startDate.format("DD-MM-YYYY"));
    });
}