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

export default function AppointmentForm({
    data,
    setData,
    errors,
    processing,
    isEdit,
    timeSlots,
    onSubmit,
    onCancel,
}) {
    return (
        <form
            onSubmit={onSubmit}
            className="space-y-5"
        >
            <div className="grid gap-5 md:grid-cols-2">

                <div>

                    <Label>Patient Name</Label>

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

                    <Label>Mobile Number</Label>

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

            </div>

            <div className="grid gap-5 md:grid-cols-2">

                <div>

                    <Label>Date</Label>

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

                    <Label>Time Slot</Label>

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

                            <SelectValue placeholder="Select Slot" />

                        </SelectTrigger>

                        <SelectContent>

                            {timeSlots.map((slot) => (

                                <SelectItem
                                    key={slot.id}
                                    value={slot.id.toString()}
                                >

                                    {slot.day} • {slot.start_time} - {slot.end_time}

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

            </div>

            <div className="flex justify-end gap-3">

                <Button
                    type="button"
                    variant="outline"
                    onClick={onCancel}
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
    );
}
