/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_print_comb.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/02 16:04:46 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/02 18:14:27 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

int		ft_putchar(char c);

void	ft_print_putchar(int nb1, int nb2, int nb3)
{
	ft_putchar(nb1 + '0');
	ft_putchar(nb2 + '0');
	ft_putchar(nb3 + '0');
	if (nb1 + nb2 + nb3 != 24)
	{
		ft_putchar(',');
		ft_putchar(' ');
	}
}

void	ft_print_comb(void)
{
	int nb1;
	int nb2;
	int nb3;

	nb1 = 0;
	while (nb1 <= 7)
	{
		nb2 = nb1 + 1;
		while (nb2 <= 8)
		{
			nb3 = nb2 + 1;
			while (nb3 <= 9)
			{
				ft_print_putchar(nb1, nb2, nb3);
				nb3++;
			}
			nb2++;
		}
		nb1++;
	}
}
