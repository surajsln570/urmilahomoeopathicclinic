import DashboardLayout from "@/layout/DashboardLayout";
import { Head } from "@inertiajs/react";

import AppointmentHeader from "@/components/appointment/AppointmentHeader";
import AppointmentCard from "@/components/appointment/AppointmentCard";
import AppointmentDialog from "@/components/appointment/AppointmentDialog";
import EmptyState from "@/components/appointment/EmptyState";

import { useState } from "react";

export default function Index({
    appointments,
    timeSlots,
}) {

    const [open, setOpen] = useState(false);

    const [selectedAppointment, setSelectedAppointment] = useState(null);

    function createAppointment() {
        setSelectedAppointment(null);
        setOpen(true);
    }

    function editAppointment(appointment) {
        setSelectedAppointment(appointment);
        setOpen(true);
    }

    return (
        <>
            <Head title="Appointments" />

            <div className="space-y-6">

                <AppointmentHeader
                    onCreate={createAppointment}
                />

                {appointments.length === 0 ? (

                    <EmptyState
                        onCreate={createAppointment}
                    />

                ) : (

                    <div className="grid gap-4">

                        {appointments.map((appointment) => (

                            <AppointmentCard
                                key={appointment.id}
                                appointment={appointment}
                                onEdit={() =>
                                    editAppointment(appointment)
                                }
                            />

                        ))}

                    </div>

                )}

                <AppointmentDialog
                    open={open}
                    setOpen={setOpen}
                    appointment={selectedAppointment}
                    timeSlots={timeSlots}
                />

            </div>
        </>
    );
}

Index.layout = (page) => (
    <DashboardLayout>{page}</DashboardLayout>
);
