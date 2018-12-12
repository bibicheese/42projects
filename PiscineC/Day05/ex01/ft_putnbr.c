/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_putnbr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/08 23:23:52 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/09 00:05:09 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

void	ft_putchar(char c);

void	is_min(int nb)
{
	if (nb / 10)
	{
		is_min(nb / 10);
	}
	ft_putchar(nb % 10 + '0');
}

void	ft_putnbr(int nb)
{
	int min;

	min = 0;
	if (nb == -2147483648)
	{
		min = 1;
		ft_putchar('-');
		is_min(214748364);
		ft_putchar('8');
	}
	if (min == 0)
	{
		if (nb < 0)
		{
			ft_putchar('-');
			nb = -nb;
		}
		if (nb / 10)
			ft_putnbr(nb / 10);
		ft_putchar(nb % 10 + '0');
	}
}
