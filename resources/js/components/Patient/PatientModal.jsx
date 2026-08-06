import { useEffect } from "react";
import { useForm } from "@inertiajs/react";

import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

export default function PatientModal({
    open,
    onOpenChange,
    patient = null,
}) {
    const isEdit = !!patient;

    const {
        data,
        setData,
        post,
        put,
        processing,
        reset,
        errors,
        clearErrors,
    } = useForm({
        name: "",
        age: "",
        sex: "male",
        religion: "hindu",
        address: "",
        remark: "",
        registrationNumber: "",
        bloodGroup: "",
        mobile: "",
        patientName: "",
    });

    useEffect(() => {
        if (patient) {
            setData({
                name: patient.name ?? "",
                age: patient.age ?? "",
                sex: patient.sex ?? "male",
                religion: patient.religion ?? "hindu",
                address: patient.address ?? "",
                remark: patient.remark ?? "",
                registrationNumber: patient.registrationNumber ?? "",
                bloodGroup: patient.bloodGroup ?? "",
                mobile: patient.mobile ?? "",
                patientName: patient.patientName ?? "",
            });
        } else {
            reset();
        }

        clearErrors();
    }, [patient, open]);

    const submit = (e) => {
        e.preventDefault();

        if (isEdit) {
            put(route("patients.update", patient.id), {
                preserveScroll: true,
                onSuccess: () => {
                    reset();
                    onOpenChange(false);
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        } else {
            post(route("patients.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    reset();
                    onOpenChange(false);
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        }
    };

    const inputClass = (field) =>
        errors[field] ? "border-red-500 focus-visible:ring-red-500" : "";

    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogContent className="max-w-4xl">
                <DialogHeader>
                    <DialogTitle>
                        {isEdit ? "Edit Patient" : "Add Patient"}
                    </DialogTitle>
                </DialogHeader>

                <form
                    onSubmit={submit}
                    className="grid grid-cols-1 md:grid-cols-2 gap-4"
                >
                    {/* Name */}
                    <div>
                        <Label>Name</Label>
                        <Input
                            className={inputClass("name")}
                            value={data.name}
                            onChange={(e) =>
                                setData("name", e.target.value)
                            }
                        />
                        {errors.name && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.name}
                            </p>
                        )}
                    </div>

                    {/* Age */}
                    <div>
                        <Label>Age</Label>
                        <Input
                            type="number"
                            className={inputClass("age")}
                            value={data.age}
                            onChange={(e) =>
                                setData("age", e.target.value)
                            }
                        />
                        {errors.age && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.age}
                            </p>
                        )}
                    </div>

                    {/* Sex */}
                    <div>
                        <Label>Sex</Label>
                        <select
                            className={`w-full border rounded-md h-10 px-3 ${errors.sex ? "border-red-500" : ""}`}
                            value={data.sex}
                            onChange={(e) =>
                                setData("sex", e.target.value)
                            }
                        >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        {errors.sex && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.sex}
                            </p>
                        )}
                    </div>

                    {/* Religion */}
                    <div>
                        <Label>Religion</Label>
                        <Input
                            className={inputClass("religion")}
                            value={data.religion}
                            onChange={(e) =>
                                setData("religion", e.target.value)
                            }
                        />
                        {errors.religion && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.religion}
                            </p>
                        )}
                    </div>

                    {/* Blood Group */}
                    <div>
                        <Label>Blood Group</Label>
                        <Input
                            className={inputClass("bloodGroup")}
                            value={data.bloodGroup}
                            onChange={(e) =>
                                setData("bloodGroup", e.target.value)
                            }
                        />
                        {errors.bloodGroup && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.bloodGroup}
                            </p>
                        )}
                    </div>

                    {/* Mobile */}
                    <div>
                        <Label>Mobile</Label>
                        <Input
                            className={inputClass("mobile")}
                            value={data.mobile}
                            onChange={(e) =>
                                setData("mobile", e.target.value)
                            }
                        />
                        {errors.mobile && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.mobile}
                            </p>
                        )}
                    </div>

                    {/* Registration Number */}
                    <div>
                        <Label>Registration Number</Label>
                        <Input
                            className={inputClass("registrationNumber")}
                            value={data.registrationNumber}
                            onChange={(e) =>
                                setData(
                                    "registrationNumber",
                                    e.target.value
                                )
                            }
                        />
                        {errors.registrationNumber && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.registrationNumber}
                            </p>
                        )}
                    </div>

                    {/* Patient Name */}
                    <div>
                        <Label>Patient Name</Label>
                        <Input
                            className={inputClass("patientName")}
                            value={data.patientName}
                            onChange={(e) =>
                                setData("patientName", e.target.value)
                            }
                        />
                        {errors.patientName && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.patientName}
                            </p>
                        )}
                    </div>

                    {/* Address */}
                    <div className="md:col-span-2">
                        <Label>Address</Label>
                        <Input
                            className={inputClass("address")}
                            value={data.address}
                            onChange={(e) =>
                                setData("address", e.target.value)
                            }
                        />
                        {errors.address && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.address}
                            </p>
                        )}
                    </div>

                    {/* Remark */}
                    <div className="md:col-span-2">
                        <Label>Remark</Label>
                        <Input
                            className={inputClass("remark")}
                            value={data.remark}
                            onChange={(e) =>
                                setData("remark", e.target.value)
                            }
                        />
                        {errors.remark && (
                            <p className="text-sm text-red-500 mt-1">
                                {errors.remark}
                            </p>
                        )}
                    </div>

                    <div className="md:col-span-2 flex justify-end">
                        <Button type="submit" disabled={processing}>
                            {processing
                                ? "Saving..."
                                : isEdit
                                    ? "Update Patient"
                                    : "Create Patient"}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
    );
}
