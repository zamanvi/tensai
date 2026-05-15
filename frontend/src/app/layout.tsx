import type { Metadata } from "next";
import { Inter } from "next/font/google";
import Providers from "@/components/shared/Providers";
import "./globals.css";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "Tensai — The Way of Global Career",
  description: "The Way of Global Career. Tensai connects verified students with global institutions through a transparent, fraud-proof digital ecosystem.",
  keywords: ["global career", "study abroad", "Japan", "student visa", "agency", "Tensai"],
  openGraph: {
    title: "Tensai — The Way of Global Career",
    description: "The Way of Global Career. Tensai connects verified students with global institutions through a transparent, fraud-proof digital ecosystem.",
    siteName: "Tensai",
    type: "website",
  },
  twitter: {
    card: "summary",
    title: "Tensai — The Way of Global Career",
    description: "The Way of Global Career. Connect. Verify. Succeed.",
  },
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en" className="h-full">
      <body className={`${inter.className} min-h-full bg-slate-50 text-slate-900 antialiased`} suppressHydrationWarning>
        <Providers>{children}</Providers>
      </body>
    </html>
  );
}
