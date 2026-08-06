import { useState } from "react";
import PatientModal from "@/components/Patient/PatientModal";
import { Button } from "@/components/ui/button";
import DataTable from "@/components/DataTable/DataTable";
import { patientColumns } from "@/components/Patient/columns";
export default function Index({ patients }) {
    const [open, setOpen] = useState(false);
    const [selectedPatient, setSelectedPatient] = useState(null);

    const handleAddPatient = () => {
        setSelectedPatient(null);
        setOpen(true);
    };

    const handleEditPatient = (patient) => {
        setSelectedPatient(patient);
        setOpen(true);
    };

    const columns = patientColumns(handleEditPatient);

    return (
        <>
            <div className="space-y-6 p-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold">
                        Patients
                    </h1>

                    <Button onClick={handleAddPatient}>
                        Add Patient
                    </Button>
                </div>
                <DataTable
                    columns={columns}
                    data={patients}
                />
            </div>

            <PatientModal
                open={open}
                onOpenChange={setOpen}
                patient={selectedPatient}
            />
        </>
    );
}
