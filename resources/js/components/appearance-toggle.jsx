import { useAppearance } from '../hooks/use-appearance';
import { cn } from '../lib/utils';
import { Moon, Sun } from 'lucide-react';

export default function AppearanceToggle({ className = '', ...props }) {
    const { appearance, updateAppearance } = useAppearance();

    const isDarkMode = appearance === 'dark';

    return (
        <button
            onClick={() => updateAppearance(isDarkMode ? 'light' : 'dark')}
            className={cn(
                'flex items-center gap-2 rounded-full bg-neutral-100 ml-1 transition dark:bg-neutral-900',
                'hover:bg-neutral-300 dark:hover:bg-neutral-700',
                className
            )}
            {...props}
        >
            {isDarkMode ? <Moon className="h-5 w-5 text-white" /> : <Sun className="h-5 w-5 text-black-500" />}
            {/*<span className="text-sm font-medium text-gray-900 dark:text-gray-100">*/}
            {/*    {isDarkMode ? 'Dark' : 'Light'} Mode*/}
            {/*</span>*/}
        </button>
    );
}
