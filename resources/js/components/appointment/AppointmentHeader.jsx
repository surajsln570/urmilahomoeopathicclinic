import { Button } from "@/components/ui/button";
import { Plus } from "lucide-react";

export default function AppointmentHeader({ onCreate }) {
    return (
        <div className="overflow-hidden rounded-xl bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 text-white shadow-lg">
            <div className="flex flex-col gap-6 p-8 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 className="text-3xl font-bold tracking-tight">
                        Appointment Management
                    </h1>

                    <p className="mt-2 text-indigo-100">
                        Manage all appointments from one place.
                    </p>
                </div>

                <Button
                    size="lg"
                    variant="secondary"
                    onClick={onCreate}
                    className="shadow-lg"
                >
                    <Plus className="mr-2 h-5 w-5" />
                    Add Appointment
                </Button>
            </div>
        </div>
    );
}
