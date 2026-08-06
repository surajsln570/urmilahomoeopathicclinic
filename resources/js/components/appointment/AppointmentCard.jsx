import { router } from "@inertiajs/react";

import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";

import {
    CalendarDays,
    Phone,
    Clock3,
    Pencil,
    Trash2,
} from "lucide-react";

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog";

import { route } from "ziggy-js";

export default function AppointmentCard({
    appointment,
    onEdit,
}) {

    function destroy() {

        router.delete(
            route("appointment.destroy", appointment.id)
        );

    }

    return (
        <Card className="transition-all hover:shadow-lg hover:-translate-y-1">
            <CardContent className="flex items-center justify-between py-5">

                {/* Left */}

                <div className="flex items-center gap-5">

                    <div className="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100">

                        <CalendarDays className="h-8 w-8 text-indigo-600" />

                    </div>

                    <div className="space-y-2">

                        <h2 className="text-xl font-semibold">
                            {appointment.patient_name}
                        </h2>

                        <div className="flex flex-wrap gap-4 text-sm text-muted-foreground">

                            <div className="flex items-center gap-1">
                                <CalendarDays className="h-4 w-4" />

                                {appointment.date}
                            </div>

                            <div className="flex items-center gap-1">
                                <Phone className="h-4 w-4" />

                                {appointment.patient_mobile}
                            </div>

                            {appointment.time_slot && (

                                <div className="flex items-center gap-1">

                                    <Clock3 className="h-4 w-4" />

                                    {appointment.time_slot.day}

                                    {" • "}

                                    {appointment.time_slot.start_time}

                                    -

                                    {appointment.time_slot.end_time}

                                </div>

                            )}

                        </div>

                    </div>

                </div>

                {/* Right */}

                <div className="flex items-center gap-3">

                    <Badge>

                        {appointment.status}

                    </Badge>

                    <Button
                        variant="outline"
                        onClick={onEdit}
                    >
                        <Pencil className="mr-2 h-4 w-4" />

                        Edit
                    </Button>

                    <AlertDialog>

                        <AlertDialogTrigger asChild>

                            <Button
                                variant="destructive"
                            >
                                <Trash2 className="mr-2 h-4 w-4" />

                                Delete
                            </Button>

                        </AlertDialogTrigger>

                        <AlertDialogContent>

                            <AlertDialogHeader>

                                <AlertDialogTitle>

                                    Delete Appointment?

                                </AlertDialogTitle>

                                <AlertDialogDescription>

                                    This action cannot be undone.

                                </AlertDialogDescription>

                            </AlertDialogHeader>

                            <AlertDialogFooter>

                                <AlertDialogCancel>
                                    Cancel
                                </AlertDialogCancel>

                                <AlertDialogAction
                                    onClick={destroy}
                                >
                                    Delete
                                </AlertDialogAction>

                            </AlertDialogFooter>

                        </AlertDialogContent>

                    </AlertDialog>

                </div>

            </CardContent>
        </Card>
    );
}
