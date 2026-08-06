import { router, usePage } from '@inertiajs/react'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
import { route } from 'ziggy-js'

export default function HeroImages({ heroImages }) {
    const { flash } = usePage().props

    const deleteHero = (id) => {
        if (confirm('Delete this hero image?')) {
            router.delete(route('hero-images.destroy', id))
        }
    }

    const toggleStatus = (id) => {
        router.put(route('hero-images.status', id))
    }

    const formatDate = (dateStr) => {
        return new Date(dateStr).toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
        })
    }

    return (
        <div className="space-y-6">
            {flash?.success && (
                <div className="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                    {flash.success}
                </div>
            )}

            <div className="flex flex-col gap-5">
                {heroImages.length === 0 ? (
                    <Card className="py-8 text-center text-gray-500">
                        No Hero Images Found
                    </Card>
                ) : (
                    heroImages.map((hero) => (
                        <Card
                            key={hero.id}
                            className="flex w-full items-center justify-between rounded-lg p-2 shadow-lg shadow-gray-300"
                        >
                            <img
                                src={`/${hero.heroimage}`}
                                alt="Hero Image"
                                className="h-20 w-30 rounded-lg border object-cover"
                            />

                            <div>{formatDate(hero.created_at)}</div>

                            <div className="flex w-[20%] items-center justify-between gap-2">
                                <Button
                                    variant="destructive"
                                    onClick={() => deleteHero(hero.id)}
                                >
                                    Delete
                                </Button>

                                <Button
                                    className={
                                        !hero.status
                                            ? 'bg-green-500 text-white hover:bg-green-600'
                                            : 'bg-red-500 text-white hover:bg-red-600'
                                    }
                                    onClick={() => toggleStatus(hero.id)}
                                >
                                    {hero.status ? 'Deactivate' : 'Activate'}
                                </Button>
                            </div>
                        </Card>
                    ))
                )}
            </div>
        </div>
    )
}
