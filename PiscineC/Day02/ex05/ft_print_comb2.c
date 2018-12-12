/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_print_comb2.c                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/02 18:40:07 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/02 20:03:43 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

void	ft_putchar(char c);

void	ft_print_putchar(int a, int b)
{
	ft_putchar((a / 10) + 48);
	ft_putchar((a % 10) + 48);
	ft_putchar(' ');
	ft_putchar((b / 10) + 48);
	ft_putchar((b % 10) + 48);
	if (a != 98)
	{
		ft_putchar(',');
		ft_putchar(' ');
	}
}

void	ft_print_comb2(void)
{
	int a;
	int b;

	a = 0;
	while (a <= 99)
	{
		b = a + 1;
		while (b <= 99)
		{
			ft_print_putchar(a, b);
			b++;
		}
		a++;
	}
}
