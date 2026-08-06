import { Button } from "@/components/ui/button";
import { CalendarX2, Plus } from "lucide-react";

export default function EmptyState({ onCreate }) {
    return (
        <div className="rounded-xl border border-dashed bg-card py-16">
            <div className="flex flex-col items-center text-center">

                <div className="mb-6 rounded-full bg-primary/10 p-5">
                    <CalendarX2 className="h-14 w-14 text-primary" />
                </div>

                <h2 className="text-2xl font-bold">
                    No Appointments Found
                </h2>

                <p className="mt-2 max-w-md text-muted-foreground">
                    There are currently no appointments.
                    Create your first appointment to get started.
                </p>

                <Button
                    className="mt-8"
                    size="lg"
                    onClick={onCreate}
                >
                    <Plus className="mr-2 h-4 w-4" />

                    Add Appointment
                </Button>

            </div>
        </div>
    );
}
