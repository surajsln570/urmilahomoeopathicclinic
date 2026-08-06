import { useEffect } from "react";
import { useForm } from "@inertiajs/react";
import { route } from "ziggy-js";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

export default function AppointmentDialog({
    open,
    setOpen,
    appointment,
    timeSlots,
}) {

    const isEdit = !!appointment;

    const {
        data,
        setData,
        post,
        processing,
        errors,
        reset,
    } = useForm({
        patient_name: "",
        patient_mobile: "",
        date: "",
        time_slot_id: "",
    });

    useEffect(() => {

        if (appointment) {

            setData({
                patient_name: appointment.patient_name ?? "",
                patient_mobile: appointment.patient_mobile ?? "",
                date: appointment.date ?? "",
                time_slot_id:
                    appointment.time_slot_id?.toString() ?? "",
            });

        } else {

            reset();

        }

    }, [appointment]);

    function submit(e) {

        e.preventDefault();

        if (isEdit) {

            post(
                route("appointment.update", appointment.id),
                {
                    _method: "put",

                    preserveScroll: true,

                    onSuccess: () => {
                        setOpen(false);
                        reset();
                    },
                }
            );

        } else {

            post(route("appointment.store"), {

                preserveScroll: true,

                onSuccess: () => {
                    setOpen(false);
                    reset();
                },

            });

        }

    }

    return (

        <Dialog
            open={open}
            onOpenChange={setOpen}
        >

            <DialogContent className="sm:max-w-xl">

                <DialogHeader>

                    <DialogTitle>

                        {isEdit
                            ? "Edit Appointment"
                            : "Add Appointment"}

                    </DialogTitle>

                    <DialogDescription>

                        Fill appointment details below.

                    </DialogDescription>

                </DialogHeader>

                <form
                    onSubmit={submit}
                    className="space-y-5"
                >

                    <div>

                        <Label>
                            Patient Name
                        </Label>

                        <Input
                            value={data.patient_name}
                            onChange={(e) =>
                                setData(
                                    "patient_name",
                                    e.target.value
                                )
                            }
                        />

                        {errors.patient_name && (

                            <p className="mt-1 text-sm text-red-500">
                                {errors.patient_name}
                            </p>

                        )}

                    </div>

                    <div>

                        <Label>
                            Mobile Number
                        </Label>

                        <Input
                            value={data.patient_mobile}
                            onChange={(e) =>
                                setData(
                                    "patient_mobile",
                                    e.target.value
                                )
                            }
                        />

                        {errors.patient_mobile && (

                            <p className="mt-1 text-sm text-red-500">
                                {errors.patient_mobile}
                            </p>

                        )}

                    </div>

                    <div>

                        <Label>
                            Appointment Date
                        </Label>

                        <Input
                            type="date"
                            value={data.date}
                            onChange={(e) =>
                                setData(
                                    "date",
                                    e.target.value
                                )
                            }
                        />

                        {errors.date && (

                            <p className="mt-1 text-sm text-red-500">
                                {errors.date}
                            </p>

                        )}

                    </div>

                    <div>

                        <Label>
                            Time Slot
                        </Label>

                        <Select
                            value={data.time_slot_id}
                            onValueChange={(value) =>
                                setData(
                                    "time_slot_id",
                                    value
                                )
                            }
                        >

                            <SelectTrigger>

                                <SelectValue placeholder="Select time slot" />

                            </SelectTrigger>

                            <SelectContent>

                                {timeSlots.map((slot) => (

                                    <SelectItem
                                        key={slot.id}
                                        value={slot.id.toString()}
                                    >

                                        {slot.day} •{" "}
                                        {slot.start_time} -{" "}
                                        {slot.end_time}

                                    </SelectItem>

                                ))}

                            </SelectContent>

                        </Select>

                        {errors.time_slot_id && (

                            <p className="mt-1 text-sm text-red-500">
                                {errors.time_slot_id}
                            </p>

                        )}

                    </div>

                    <div className="flex justify-end gap-3">

                        <Button
                            type="button"
                            variant="outline"
                            onClick={() =>
                                setOpen(false)
                            }
                        >
                            Cancel
                        </Button>

                        <Button
                            disabled={processing}
                        >

                            {processing
                                ? "Saving..."
                                : isEdit
                                    ? "Update Appointment"
                                    : "Create Appointment"}

                        </Button>

                    </div>

                </form>

            </DialogContent>

        </Dialog>

    );

}
